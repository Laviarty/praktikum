<?php
$mf = fopen("../../Input/test.txt","w");
fwrite($mf,"test\n");
if (isset($_FILES['files'])) {
    fwrite($mf,"ifcase");
    $total = count($_FILES['files']['tmp_name']);
        for($i=0; $i < $total ; $i++){
            $tmpFilePath = $_FILES['files']['tmp_name'][$i];
        
            if($tmpFilePath != ""){
                $newFilePath = "../Input/".$_FILES['files']['name'][$i];            
                move_uploaded_file($tmpFilePath, $newFilePath);
            }   
        }   
}
?>