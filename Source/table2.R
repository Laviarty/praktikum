library(RMySQL) #Zum verbinden zur Datenbank
library(DBI)
library(affy) #Affy Lib
library(AnnotationDbi)  #Funktionen für Annotation
library(hgu133plus2.db) #Annotation Data


con<- dbConnect(RMySQL::MySQL(),user='fabian',password='1234',dbname='praktikum',host='127.0.0.1')


makeTable <- function(file,type) {
  
  rframe<- readExpressionSet(file, stringsAsFactors = FALSE) #einlesen der benötigten TEMP Datei
  write.exprs(rframe,file="temp.txt", sep=";") #schreibt Eset mit RMA Signalen in TXT
  rframe<- read.table("temp.txt", sep=";", stringsAsFactors = FALSE, header=TRUE)
  
  lines<- dim(rframe)[1] #Länge der Tabelle, benötigt um Signalspalte zu erstellen
  
  #Signaltypspalte erstellen:
  v<- c(rep(type,lines)) #fügt den Signaltyp so oft in einen Vektor ein, wie es Zeilen in der Signaltabelle gibt
  sigframe<- data.frame(v) #erstellt Tabelle mit dem Vektor als inhalt
  
  valframe<- cbind(rframe,sigframe) #Kleben von rframe und sigframe
  
  #GeneNames erstellen:
  k<- keys(hgu133plus2.db,keytype="PROBEID") #Wählt alle Probe ID's als Key aus
  geneframe<- select(hgu133plus2.db, keys=k, columns=c("SYMBOL","GENENAME"), keytype="PROBEID") #Mapped Probe ID's auf SYMBOL und GENENAME und gibt Tabelle aus
  
  #Mapped der GeneNames auf valframe, da mehr als ein Gen pro ID:
  #finframe<- data.frame()
  finframe<- merge(x= geneframe, y= valframe, by.x= "PROBEID", by.y="X", all = TRUE)
  
  if(file.exists("temp.txt")){file.remove("temp.txt")}
  
  return(finframe)
}

getmedian <- function(finframe){
  #MEDIAN BERECHNUNG FÜR SCATTER:
  #Zwei neue Spalten einfügen: Median Gesund, Median Krank
  readtype <- readLines("../Output/type.txt")              #ließt datei mit Datentyp info ein
  type<- unlist(strsplit(readtype[1],""))                  #macht str zueinem Vector
  names<- unlist(strsplit(readtype[2],","))                #macht str zueinem Vector
  names <- names[3:length(names)]                          #Löscht Element 1 und 2, da diese keine Daten enthalten
  
  notype<-c()
  desease<-c()
  control<-c()
  for(i in 1:length(names)){                               #creates three lists: Notype, Desease, Control
    if(type[i] == "1"){
      #Type 1 means no value was given
      notype<-c(notype, names[i])
    }else if(type[i] == "2"){
      #Type 2 means Deseasese
      desease<- c(desease, names[i])
    }else if(type[i] == "3"){
      #Type 3 means Control
      control<- c(control, names[i])
    }else{
      print("ERROR unknown Type Value!")
    }
  }
  
  chiporder<- c(notype,desease,control)
  finframe<-finframe[c("PROBEID","GENESYMBOL", "GENENAME", "SIGNALTYPE", chiporder)] #Reihenfolge der Spalten
  
  #rowssums berechnen
  if(length(notype) == length(names)){       #falls keine Types definiert wurden gib den frame zurück
    return(finframe)
  }else{                                     #ansonsten berechne Median
    startdesease<- (5+length(notype))
    enddesease<- startdesease + length(desease)-1
    startcontrol<-enddesease+1
    averagedesease<- rowSums(finframe[,startdesease:enddesease])/length(desease)
    averagecontrol<- rowSums(finframe[,startcontrol:ncol(finframe)])/length(control)
    
    print(startdesease)
    print(enddesease)
    print(startcontrol)
    print(ncol(finframe))
    finframe<-cbind(finframe,averagedesease,averagecontrol)
  }
  
  
  return(finframe)
}


#MAIN:

chipnames<- featureNames(phenoData(ReadAffy(celfile.path="../Input/")))
rmaTable<- makeTable("../Output/rma.txt","RMA") #erstellt Tabelle für RMA-Signale
masTable<- makeTable("../Output/mas.txt","MAS 5.0") #erstellt Tabelle für MAS-Signale

#Kleben:
finframe<- rbind(rmaTable,masTable)
#Kosmetik:



colnames(finframe)<-c("PROBEID","GENESYMBOL", "GENENAME", chipnames, "SIGNALTYPE") #benennen der Spalten, chipnames = Namen der eingelesenen dateien
finframe<-finframe[c("PROBEID","GENESYMBOL", "GENENAME", "SIGNALTYPE", chipnames)] #Reihenfolge der Spalten

#Berechnen der Median Werte:
finframe<-getmedian(finframe)
colnames(finframe)<-c("PROBEID","GENESYMBOL", "GENENAME", "SIGNALTYPE", chipnames, "AVERAGE DESEASE", "AVERAGE CONTROL")

#Ausgabe:

if(dbExistsTable(con,"exprtable")){ #Falls Table existiert
  dbWriteTable(con, value=finframe, name="exprtable", overwrite=TRUE) #Überschreibt alte Daten
}else{
  #query<- "CREATE TABLE exprtable("+colnames(finframe)+")"
  #dbSendQuery(con,"CREATE TABLE exprtable();")
  dbWriteTable(con, name="exprtable", value=finframe) #Schreibt Daten
}
  
write.csv(finframe,file="../Output/signalTable.csv")
