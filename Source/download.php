<?php
	$files = glob("../Output/*.*");
//if(!empty($files)
if(true)
   {
	$zipname = 'Expressionsanalyse.zip';
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::CREATE);
	foreach ($files as $file) {
  		$zip->addFile($file);
	}
	$zip->close();

	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zipname);
	header('Content-Length: ' . filesize($zipname));
	readfile($zipname);
exit;
}
?>