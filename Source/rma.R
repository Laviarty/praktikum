library(affy)

data = ReadAffy(celfile.path="../Input")

write.exprs(rma(data), file="../Output/rma.txt")


