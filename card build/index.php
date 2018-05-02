<!DOCTYPE HTML>
<html>
    <head>
        <title>Softwarepraktikum 2018</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="css/dropzone.css">
        
        <script src="Scripts/dropzone.js"></script>
        
        <!--+++++++++++++++++++Die Scripte solten eigentlich ans ende von Body+++++++++++++++++++++++++++++++-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        
        <!--<script>Dropzone.autoDiscover = false;</script>-->
    </head>
    
    <body>
        <div id="accordion">
            <!-- ++++++++++++++++++++++UPLOAD CARD ++++++++++++++++++++++++++++++++++++++++-->
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Upload
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <!--++++++++++++START OF UPLOAD+++++++++++++++++++-->
                        <section>
                            <form id="projectform">
                                Enter your Projectname:
                                <input type="text" id="projectname">
                            </form>
                            
                            <!-- +++++++++++++++++++++++Selected Files ++++++++++++++++-->
                            <div id="filestoupload">
                        <table id="filelist" class="form" border="1">
                            <tbody>
                            <tr>
                            <td>
                                <script>
                                    function filelist(){
                                        var table = document.getElementById("filelist");
                                        var filelist = document.getElementById('files[]').files;
                                        
                                        /*document.getElementById('test').innerHTML = filelist[1].name;*/
                                        var fileCount = filelist.length;
                                        if(fileCount > 0){
                                            
                                            for(var i=0; i < fileCount; i++){
                                                var rowCount = table.rows.length;
                                                var row = table.insertRow(rowCount);
                                                
                                                for( var j=0; j < 2; j++){
                                                    var newcell = row.insertCell(j);
                                                    
                                                    if(j == 0){
                                                        newcell.innerHTML = filelist[i].name;
                                                    }
                                                    else{
                                                        newcell.innerHTML = '<label class="btn btn-danger btn-sm removeBtn">   <i class="fa fa-minus"></i> <span></span></label>';
                                                    }
                                                }
                                            }
                                        }
                                   }
                                </script>
                            
                            </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            
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
                                <label class="btn btn-success fileinput-button myButton">
                                    <i class="fa fa-plus"></i>
                                    <span>Add Files</span>
                                    <input type="file" name="files[]" id="files[]" onchange="filelist()" multiple hidden>
                                     
                                </label>
            
                                <label class="btn btn-primary start myButton" >
                                    <i class="fa fa-arrow-circle-o-up"></i>
                                    <span>Start Upload</span>
                                    <input type="submit" value="upload" hidden>
                                </label>
            
                                <label type="reset" class="btn btn-warning cancel myButton">
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
                            echo '<script>$("#collapseTwo").load("index.php" + "#collapseTwo")</script>'
                        ?>
                        
                    </div>
                </div>
            </div>
            
            <!-- ++++++++++++++++++++++PROCESSING CARD ++++++++++++++++++++++++++++++++++++++++-->
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Processing
                    </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <!-- +++++++++++++++++++++ CODE FOR PROCESSING++++++++++++++++++++++++-->
                        <div>
                            <p id="info"></p>
                            <form method="post" name="form" id="form">
                                <div id="formcontent"></div>
                                <script>
                                    /*Get all names from files in input folder*/
                                    var names = <?php $dir = '../Input'; $names = scandir($dir); echo json_encode($names);?>;
                                    var namesCount = names.length;
                                    
                                    /*has always two entries, so two means Input is empty*/
                                    if(namesCount == 2){
                                        document.getElementById("info").innerHTML = "Please upload some files first!";
                                    }
                                    /*Show instruction when there are files*/
                                    else{
                                        document.getElementById("info").innerHTML = "Select if the file contains diseased or control data:";
                                        
                                        var buffer= "";
                                        var template1='<section><label>';
                                        var template2 = '</label><select name="select"><option value=1></option><option value=2>Desease</option><option value=3>Control</option></select></section>'
                                        for(i=2; i < namesCount; i++){
                                            buffer = buffer.concat(template1,names[i],template2);            
                                        }
                                        document.getElementById("formcontent").innerHTML = buffer;
                                    }
                                </script>
                                <section id="analysebtn"></section>
                                <script>
                                    var names = <?php $dir = '../Input'; $names = scandir($dir); echo json_encode($names);?>;
                                    var namesCount = names.length;
                                    if(namesCount != 2){
                                        document.getElementById('analysebtn').innerHTML= '<label class="btn btn-primary start" id="analyse"><i class="fa fa-play"></i><span>Analyse</span><input type="submit" value="Submit" onclick="readselect()" id="analyse" hidden></label>'
                                    }
                                </script>
                            </form>
                            
                            <p id="runinfo"></p>
                            <script>
                                function readselect(){
                                    var type = $('form').serialize();
                                    var type2 = type.replace(/&|select=/gi, "");
                
                                    document.getElementById('runinfo').innerHTML = type2;
                
                                    window.location.href = "./Scripts/Ranalyse.php?name=" + type2;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
            
            
            <!-- ++++++++++++++++++++++ RESULUTS CARD ++++++++++++++++++++++++++++ -->
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Results
                    </button>
                    </h5>
                </div>
                
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                    <!-- +++++++++++++++++++++ CODE FOR RESULTS++++++++++++++++++++++++-->
                    Results will be shown here
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>