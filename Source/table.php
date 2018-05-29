<?php
$values=[];
$values= explode(",",$_GET['values']);


$table = "";
$dbServer = "127.0.0.1";
$dbUser = "fabian";
$dbPassword = "1234";
$dbName = "praktikum";
    
$con =mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);


    //echo "<p>Search values:".implode($values)."</p>";



//MASTERQUERRY:
$template= "SELECT * FROM exprtable WHERE ";
$counter=0; //Zeigt an ob bereits eine WHERE condition definiert wurde

$result = mysqli_query($con, "SELECT * FROM exprtable;");

if(empty(array_filter($values))){
    $result = mysqli_query($con, "SELECT * FROM exprtable;");
}else{    
if(!empty($values[0])){
    $template=$template."PROBEID="."'".$values[0]."'";
    $counter=1;
}
if(!empty($values[1])){
    if($counter != 0){
        $template=$template." AND ";
    }
    $template=$template."GENESYMBOL="."'".$values[1]."'";
    $counter=$counter+1;
    
}
if(!empty($values[2])){
    if($counter != 0){
    $template=$template." AND ";
    }
    $template=$template."SLR >"."'".$values[2]."'";
    $counter=$counter+1;
    
}
if(!empty($values[3])){
    if($counter != 0){
    $template=$template." AND ";
    }
    $template=$template."SLR <"."'".$values[3]."'";
    $counter=$counter+1;
    
}
if(!empty($values[4])){
    if($counter != 0){
    $template=$template." AND ";
    }
    $template=$template."SIGNALTYPE='RMA'";
    $counter=$counter+1;
    
}
if(!empty($values[5])){
    if($counter != 0){
    $template=$template." AND ";
    }
    $template=$template."SIGNALTYPE='MAS 5.0'";
    $counter=$counter+1;
}
$template=$template.";";
$result = mysqli_query($con, $template);
}
//echo "<p>".$template."</p>";


$colnames = mysqli_query($con, "SELECT column_name FROM information_schema.columns WHERE  table_name = 'exprtable' AND table_schema = 'praktikum';");
while($row=mysqli_fetch_assoc($colnames)){
    $names[]=$row['column_name'];
}
$namesCount=count($names);
$n =0;
        
$resultcheck = mysqli_num_rows($result);
if($resultcheck > 0){
    $table .= "<table><tr>";
    for($i=1; $i < $namesCount;$i++){                
        if(strlen($names[$i]) > 15){
            $table .= "<th>".substr($names[$i],0,15)."...</th>";
        }
        else{
        $table .= "<th>".$names[$i]."</th>";
        }
    }
    $table .= "<tr>";
    while($row=mysqli_fetch_assoc($result) and $n < 200){
        $table .= "<tr>";
        for($i=1; $i < $namesCount ;$i++){
            $table .= "<td>".$row[$names[$i]]."</td>";   
        }
        $table .= "</tr>";
        $n = $n+1;
    }
   $table .= "</table>";
}
echo $table;

?>