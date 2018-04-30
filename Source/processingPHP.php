<!DOCTYPE HTML>
<html>
<head>
    <title>TEST Processing</title>
        
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    <link rel="stylesheet" href="css/dropzone.css">
</head>
    
<body>
    <div id="outer">
        <div>
            <h1>Select if the file contains diseased or control data:</h1>
            
            <table id="namefiles" class="form" border="1">
                <tbody>
                    
                    
                    <script>
                    var table = document.getElementById("namefiles");
                    
                    var names = <?php $dir = '../Input'; $names = scandir($dir); echo json_encode($names);?>;
                    var namesCount = names.length;
                        
                    for(var i=3; i < namesCount; i++){
                        var rowCount = table.rows.length;
                        var row = table.insertRow(rowCount);
                        
                        for( var j=0; j < 2; j++){
                            var newcell = row.insertCell(j);
                            if(j == 0){
                                newcell.innerHTML = names[i];/*table.rows[0].cells[j].innerHTML;*/    
                            }
                            else{
                                newcell.innerHTML = "<select><option>...</option><option>Control</option><option>Diseased</option></select>"
                            }
                            
                        }
                    }
                    
                    </script>
                </tbody>
            </table>
        </div>
        <div>
        <form action="./Scripts/runc.php" method="post" id="submit">
            <label class="btn btn-primary start" >
                <i class="fa fa-play"></i>
                <span>Analyse</span>
                <!--<input action="/Scripts/upload.php" method="post" id="submit" hidden>-->
                <input type="submit" hidden>
            </label>
            </form>
        </div>
        
    </div>
    
</body>
</html>