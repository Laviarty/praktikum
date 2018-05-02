library(affy)
library(affyQCReport)
library(AnnotationDbi)
library(affydata) #for testing
library(affyPLM) #for heatmap

#1. Signalkurve
#2. Korrelationsplot
#3. RNA-degeneration
#4. Box-Plot
#5. Scatter-Plot

#read files:
dat<- ReadAffy()
names <- featureNames(phenoData(dat))
l<- length(featureNames(phenoData(dat)))


rma<- rma(dat)

#1. Signalverteilungskurve:
#1.1 vor normalisierung:
jpeg('signalkurve.jpeg',width=1400,height=1400)
hist(dat,col=c(2:l))
legend("topright", legend = names, col=c(1:l), lty = 1)
dev.off()

#1.2 Normalisiert:
jpeg('signalkurve_RMAnormalisiert.jpeg',width=1400,height=1400)
hist(rma,col=c(2:l))
legend("topright", legend = names, col=c(1:l), lty = 1)
dev.off()

#2. Correlation plot, für alle CEL-Files einer Gruppe:
#2.1 GROUP1
jpeg('correlation_group1.jpeg')
correlationPlot(dat)
dev.off()
#2.2 GROUP2

#3. RNA degeneration, all CEL files:
deg<- AffyRNAdeg(dat) #erstellt analyse
jpeg('RNAdeg.jpeg',width=1400,height=1400)
plotAffyRNAdeg(deg, cols= c(1:l)) #erstellt plot
legend("bottomright", legend = names, col=c(1:l), lty = 1)
dev.off()


#4. Boxplot für jedes CEL file:
par(mfrow=c(1,l))
jpeg('boxplot.jpeg')
boxplot(dat, col=c(2:l)) #hier noch farben anpassen an anzahl CEL-Files
dev.off()

#5. Scatter Plot:
#Benötigt Median Signal werte für jeweils Gesund/Krank für jedes Gen
read <- read.csv(file="Group1.csv",header=TRUE, sep=";", dec=",")
x<- read[1:58395,14]#Median Gesund
y<- read[1:58395,15]#Median Krank
jpeg('scatter.jpeg')
#smoothScatter(x,y, xlab= "Gesund", ylab= "Krank")
plot(x,y, xlab="Gesund", ylab="Krank")
abline(a=0,b=1,col="red")
dev.off()

#6. Images:
#6.1 Topo

#6.2 Heat 
#Darstellung mit ProbeLevelModel
ab<-fitPLM(dat)

for(i in 1:l){
  n<- paste("heat_",toString(names[i]), ".jpeg", sep="")
  jpeg(n, width=12000,height=12000)
  affy::image(ab, which=i, add.legend=TRUE)
  dev.off()
}

#Residuals-Filter.
for(i in 1:l){
  n<- paste("resids_",toString(names[i]), ".jpeg", sep="")
  jpeg(n, width=12000,height=12000)
  affy::image(ab, which=i, add.legend=TRUE, type="resids")
  dev.off()
}
#jpeg('heatweights.jpeg',12000,12000)
#image(ab,add.legend=TRUE,type="resids")
#dev.off()

#Test mit Dilution:
#library("affyPLM")
#data(Dilution)
#affybatch<-Dilution
#ab<-fitPLM(Dilution)
#jpeg('weighttest.jpeg',12000,12000)
#image(x= "PLMset",ab,add.legend=TRUE,type="resids")
#dev.off()

#6.3 Black/White:
for(i in 1:l){
  n<- paste(toString(names[i]),".jpeg",sep="")
  jpeg(filename= n ,width=12000,height=12000)
  image(dat[,i], transfo=log)
  dev.off()
}