library(affy)

data = ReadAffy(celfile.path="../Input")
#esetRMA = rma(data)
esetRMA = readExpressionSet("../Output/rma.txt", stringsAsFactors = FALSE)

jpeg('../Output/heatmapRMA.jpeg',width=700,height=700)
par(mar=c(17,3,2,1))
heatmap(exprs(esetRMA[1:100,]), main="Heatmap RMA")
dev.off()

esetMAS = readExpressionSet("../Output/mas.txt", stringsAsFactors = FALSE)

jpeg('../Output/heatmapMAS.jpeg',width=700,height=700)
par(mar=c(17,3,2,1))
heatmap(exprs(esetMAS[1:100,]), main="Heatmap MAS5")
dev.off()
