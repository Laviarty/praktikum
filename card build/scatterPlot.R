
read <- read.csv(file="../Output/signalTable.csv",header=TRUE, sep=",")
rows<-  floor(nrow(read)/2)
x<- read[1:rows, ncol(read)]#Median Gesund
y<- read[1:rows, ncol(read)-1]#Median Krank
jpeg('../Output/scatter.jpeg')
#smoothScatter(x,y, xlab= "Gesund", ylab= "Krank")
plot(x,y, xlab="Gesund", ylab="Krank", pch=16,cex=0.4)
abline(a=0,b=1,col="red")
dev.off()