library(affy)
library(affyQCReport)
Pfad = "../Input"
data = ReadAffy(celfile.path=Pfad)
esetRMA = readExpressionSet("../Output/rma.txt", stringsAsFactors = FALSE)

l<- length(featureNames(phenoData(esetRMA)))
names <- featureNames(phenoData(esetRMA))

#1. Signalverteilungskurve:
#1.1 vor normalisierung:
jpeg('../Output/signalkurve.jpeg',width=700,height=700)
hist(data,col=c(2:l), main="Signalverteilung")
legend("topright", legend = names, col=c(1:l), lty = 1)
dev.off()

jpeg('../Output/signalkurve_RMAnormalisiert.jpeg',width=700,height=700)
hist(esetRMA,col=c(2:l), main="Signalverteilung RMA-normalisiert")
legend("topright", legend = names, col=c(1:l), lty = 1)
dev.off()