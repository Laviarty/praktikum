<?php
    if (isset($_FILES['files'])) {
        $total = count($_FILES['files']['tmp_name']);
                    
        for($i=0; $i < $total ; $i++){
            $tmpFilePath = $_FILES['files']['tmp_name'][$i];
                
            if($tmpFilePath != ""){
                $newFilePath = "../".$_FILES['files']['name'][$i];
                        
                move_uploaded_file($tmpFilePath, $newFilePath);
            }
        }   
    }
?>