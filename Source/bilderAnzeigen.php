<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="../css/images.css">
		<link rel="stylesheet" href="../css/dropzone.css">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	
		<body>
			
			<div>
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
			</div>
		<script src="modalImages.js"></script>
		
		
	  </body>
</html>