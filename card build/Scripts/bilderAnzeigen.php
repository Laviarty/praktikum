<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="../css/images.css">
		<link rel="stylesheet" href="../css/dropzone.css">
	</head>
		<body>
			<h1>Analyse</h1>
					<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
	<div>
			<?php
     $files = glob("../../Output/*.*");
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
            echo "<h2>".basename($image)."</h2>"."<br />";
             echo '<img src="'.$image .'" alt=" '.basename($image).'" onclick="showModal(this)" />';
				 echo "<br /><br />";
            } else {
                continue;
            }
          }
       ?>
			</div>
		<script src="modalImages.js"></script>
		
		
	  </body>
</html>