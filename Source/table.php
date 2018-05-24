<?php
$table = "";
$dbServer = "127.0.0.1";
$dbUser = "fabian";
            $dbPassword = "1234";
            $dbName = "praktikum";
    
            $con =mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
        
            $result = mysqli_query($con, "SELECT * FROM exprtable;");
            $colnames = mysqli_query($con, "SELECT column_name FROM information_schema.columns WHERE  table_name = 'exprtable' AND table_schema = 'praktikum';");
            while($row=mysqli_fetch_assoc($colnames)){
                $names[]=$row['column_name'];
            }
            $namesCount=count($names);
            $n =0;
        
            $resultcheck = mysqli_num_rows($result);
            if($resultcheck > 0){
                $table .= "<table><tr>";
                for($i=2; $i < $namesCount;$i++){
                    
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
                    for($i=2; $i < $namesCount ;$i++){
                        $table .= "<td>".$row[$names[$i]]."</td>";   
                    }
                    $table .= "</tr>";
                    $n = $n+1;
                }
               $table .= "</table>";
            }
echo $table;

        ?>