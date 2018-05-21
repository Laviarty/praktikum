<?php            
    /*if(isset($_POST['submit'])) {}*/

echo "gestartet";
    $dir = '../../Input';
    $names = scandir($dir);
    $fp = fopen("../../Output/type.txt", "w+");

    $selectoption = $_GET['name'];
    /*file_put_contents("../../Output/type.txt", $selectoption."\n");*/
    fwrite($fp, $selectoption."\n");
    
    foreach($names as $key => $value){
        fwrite($fp, $value.",");
    }
    fclose($fp); 

    $output = exec("cd ..;unset LD_LIBRARY_PATH; Rscript Alle.R", $output, $return);
                   
?>