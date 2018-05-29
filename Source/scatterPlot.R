
read <- read.csv(file="../Output/signalTable.csv",header=TRUE, sep=",")
rows<-  floor(nrow(read)/2)
x<- read$AVERAGE.CONTROL[1:rows]#Median Gesund
y<- read$AVERAGE.DESEASE[1:rows]#Median Krank
jpeg('../Output/scatter.jpeg')
#smoothScatter(x,y, xlab= "Gesund", ylab= "Krank")
plot(x,y, xlab="Gesund", ylab="Krank", pch=16,cex=0.4)
abline(a=0,b=1,col="red")
dev.off()