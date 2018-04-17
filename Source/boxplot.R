library(affy)
library(affyQCReport)

Pfad = "../Input"
data = ReadAffy(celfile.path=Pfad)
esetRMA = readExpressionSet("../Output/rma.txt", stringsAsFactors = FALSE)

l<- length(featureNames(phenoData(data)))


jpeg('../Output/boxplot.jpeg')
par(mar=c(17,3,2,2))
par(mfrow=c(1,2))
boxplot(data, col=c(2:l), las=2, main = "Boxplot") #hier noch farben anpassen an anzahl CEL-Files
#dev.off()

#jpeg('../Output/boxplot_RMAnorm.jpeg')
boxplot(esetRMA, col=c(2:l), las=2, main ="Boxplot RMA-normalisiert") #hier noch farben anpassen an anzahl CEL-Files
dev.off()
