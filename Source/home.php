<!DOCTYPE HTML>
<html>
    <head>
        <title>Softwarepraktikum 2018</title>
        
       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="css/dropzone.css">
        
        <script src="Scripts/dropzone.js"></script>
        
        <!--+++++++++++++++++++Die Scripte solten eigentlich ans ende von Body+++++++++++++++++++++++++++++++-->
       		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        
        <!--<script>Dropzone.autoDiscover = false;</script>-->
    </head>
    
    <body>
		
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="./bilderAnzeigen.php">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
  </div>
</nav>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>HOME</h3>
    <div><div >
                    <div >
                        <!--++++++++++++START OF UPLOAD+++++++++++++++++++-->
                        <section>
                            <form id="projectform">
                                Enter your Projectname:
                                <input type="text" id="projectname">
                            </form>
                            <div id="dropzone">
                                <form action="./Scripts/uploadDropzone.php" class="dropzone dz-clickable" id="demo-upload" enctype="multipart/form-data">
                                    <div class="dz-message">Drop files here or click to upload.</div>
                                        <div  class="fallback">
                                            <input type="file" name="files[]" multiple>
                                        </div>
                                </form>
                            </div>
                        </section>
    
                        <!--+++++++++++++++++UPLOAD BUTTONS+++++++++++++++++++++++-->
                        <div id="btnAndProgress">
                            <div class="row" id="buttons">
                            <form method="post" enctype="multipart/form-data" id="Upload">
                            <div class="row">
                                <label class="btn btn-success fileinput-button">
                                    <i class="fa fa-plus"></i>
                                    <span>Add Files</span>
                                    <input type="file" name="files[]" id="files[]" onchange="filelist()" multiple hidden>
                                     
                                </label>
            
                                <label class="btn btn-primary start" >
                                    <i class="fa fa-arrow-circle-o-up"></i>
                                    <span>Start Upload</span>
                                    <input type="submit" value="upload" hidden>
                                </label>
            
                                <label type="reset" class="btn btn-warning cancel">
                                    <i class="fa fa-ban"></i>
                                    <span>Cancel Upload</span>
                                    <input onclick=reload() hidden>
                                    <script> function reload(){location.reload();}</script>
                                </label>
                            </div>
                            </form>
                            </div>
        
                            <!-- ++++++++++++++++++PROGRESS BAR (NOT IMPLEMENTED!) +++++++++++++-->
                            <!--
                            <div id="progress" class="row">
                                
                                <span class="fileupload-process">
                                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"   aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                                </span>
                            </div>-->
                        </div>
                        
                        <table>
                            <tbody>
                                <script>
                                    function filelist(){
                                        var filelist = document.getElementById('files[]').files;
                                        document.getElementById('test').innerHTML = filelist;
                                        var fileCount = filelist.length;
                                        if(fileCount > 2){
                                            for(var i=3; i < fileCount; i++){
                                                var rowCount = table.rows.length;
                                                var row = table.insertRow(rowCount);
                                                    
                                                var newcell = row.insertCell(0);
                                                newcell.innerHTML = filelist[i]; 
                                            }
                                        }
                                   }
                                </script>
                                    
                            </tbody>
                        </table>
                        <!-- ++++++++++++++++++++++UPLOAD PHP ++++++++++++++++++++++++++++++++-->
                        
                        <?php
                            if (isset($_FILES['files'])) {
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
                    </div>
                </div>
	  </div>
	</div>
		</div>
	  </body>
</html>