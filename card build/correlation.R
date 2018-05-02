library(affy)
library(affyQCReport)
Pfad = "../Input"
data = ReadAffy(celfile.path=Pfad)

jpeg('../Output/correlation.jpeg')
correlationPlot(data)
dev.off()