<?php
$file = $_FILES['uploadfile']; //Nimm File entgegen

if(!empty($file['name'])){
    move_uploaded_file($file['tmp_name'], "Input/".$file['name']); //Speichere File in input
}