library(affy)

data = ReadAffy(celfile.path="../Input")

names <- featureNames(phenoData(data))
l<- length(featureNames(phenoData(data)))

for(i in 1:l){
  n<- paste("../Output/",toString(names[i]),".jpeg",sep="")
  jpeg(filename= n,width=12000,height=12000)
  image(data[,i], transfo=log)
  dev.off()
}