<?php
function debug_to_consoled( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	
debug_to_consoled("gestartet");

	$files = glob("../Output/*.*");

if(!empty($files))
   {
	$zipname = 'Expressionsanalyse.zip';
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::CREATE);
	debug_to_consoled("zip created");
	foreach ($files as $file) {
  		$zip->addFile($file);
		}
	$zip->close();

	header('Content-type: application/zip');
	header('Content-Disposition: attachment; filename='.$zipname);
	header('Content-Length: ' . filesize($zipname));
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
	readfile($zipname);
	exit;
	}
   
   
   
}
?>