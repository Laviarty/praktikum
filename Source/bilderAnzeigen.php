<?php
//debug_to_console("test");
     $files = glob("../Output/*.*");

		  $imageDiv = "";
     for ($i=0; $i<count($files); $i++)
      {
        $image = $files[$i];
        $supported_file = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
         );

         $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
         if (in_array($ext, $supported_file)) {
			 $imageDiv .= '<div class="modalDiv">';
            $imageDiv .= "<h3>".basename($image)."</h3>"."<br />";
             $imageDiv .= '<img src="'.$image .'" alt=" '.basename($image).'" onclick="showModal(this)" class="modalImage"/>';
			$imageDiv .= "<br /><br />";
			 $imageDiv .= '</div>';
			 //debug_to_console($imageDiv);
            } else {
                continue;
            }
          }
echo $imageDiv;

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
       ?>