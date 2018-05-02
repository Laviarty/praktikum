library(affy)
library(affyQCReport)

Pfad = "../Input"
data = ReadAffy(celfile.path=Pfad)
esetRMA = readExpressionSet("../Output/rma.txt", stringsAsFactors = FALSE)

deg<- AffyRNAdeg(data) #erstellt analyse
jpeg('../Output/RNAdeg.jpeg',width=700,height=700)
plotAffyRNAdeg(deg, cols= c(1:l)) #erstellt plot
legend("bottomright", legend = names, col=c(1:l), lty = 1)
dev.off()

