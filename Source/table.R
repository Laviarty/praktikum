library(affy) #Affy Lib
library(AnnotationDbi)  #Funktionen für Annotation
library(hgu133plus2.db) #Annotation Data

makeTable <- function(file,type) {
  
  rframe<- readExpressionSet(file, stringsAsFactors = FALSE) #einlesen der benötigten TEMP Datei
  write.exprs(rframe,file="temp.txt", sep=";",dec=",") #schreibt Eset mit RMA Signalen in TXT
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



#MAIN:

chipnames<- featureNames(phenoData(ReadAffy(celfile.path="../Input/")))
rmaTable<- makeTable("../Output/rma.txt","RMA") #erstellt Tabelle für RMA-Signale
masTable<- makeTable("../Output/mas.txt","MAS 5.0") #erstellt Tabelle für MAS-Signale

#Kleben:
finframe<- rbind(rmaTable,masTable)
#Kosmetik:

colnames(finframe)<-c("PROBEID","GENESYMBOL", "GENENAME", chipnames, "SIGNALTYPE") #benennen der Spalten, chipnames = Namen der eingelesenen dateien
finframe<-finframe[c("PROBEID","GENESYMBOL", "GENENAME", "SIGNALTYPE", chipnames)] #Reihenfolge der Spalten

#Ausgabe:
write.csv(finframe,file="../Output/signalTable.csv")
