library(affy)

phenoData<- phenoData(ReadAffy(celfile.path="./Input/"))

write.AnnotatedDataFrame(phenoData,"./Output/phenoData.txt")