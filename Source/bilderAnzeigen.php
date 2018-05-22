<?php
     $files = glob("../Output/*.*");
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
		  $imageDiv = "";
         if (in_array($ext, $supported_file)) {
			 $imageDiv .= '<div class="modalDiv">';
            $imageDiv .= "<h3>".basename($image)."</h3>"."<br />";
             $imageDiv .= '<img src="'.$image .'" alt=" '.basename($image).'" onclick="showModal(this)" class="modalImage"/>';
				 $imageDiv .= "<br /><br />";
			 $imageDiv .= '</div>';
            } else {
                continue;
            }
          }
echo $imageDiv;
       ?>