<?php            
    /*if(isset($_POST['submit'])) {}*/

//echo "gestartet";
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

        /*lösche type.txt*/
    array_map('unlink', glob("../../Output/*.txt"));
    
    $files = glob("../../Output/*.*");
    if(!empty($files)){
	   $zipname = '../../Output/Expressionsanalyse.zip';
	   $zip = new ZipArchive;
	   $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
	   /*debug_to_consoled("zip created");*/
	   foreach ($files as $file) {
  		    $zip->addFile($file);
        }
    $zip->close();
    }
                   
?>