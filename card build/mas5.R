library(affy)

data = ReadAffy(celfile.path="../Input")
write.exprs(mas5(data), file="../Output/mas.txt")


