var filelist= []; //Array mit Hochzuladenen Files
var totalSize= 0; //Gesamtgröße der hochzuladenen Dateien
var totalProgress= 0; //aktueller Fortschritt des Uploads
var currentUpload= null; //Datei die aktuell hochgeladen wird

document.getElementById('uploadzone').addEventListener('drop', handleDropEvent, false); //Wartet darauf, dass etwas auf das Feld gezogen wird

function handleDropEvent(event){ //Funktion die durch Drop ausgelöst wird
    event.stopPropagation();
    event.preventDefault();
    
    for(var i=0; i < event.dataTransfer.files.length; i++){ //Für alle hochzuladenen Files
        filelist.push(event.dataTransfer.files[i]); //Hinzufügen zu Uploadqueue
        totalSize += event.dataTransfer.files[i].size; //Hinzufügen zu Gesamtuploadgröße
    }
}

function startNextUpload(){
    if(filelist.length){ //Prüft ob noch Dateien in der Liste sind
        currentUpload= filelist.shift() //Nächste Datei holen
        uploadFile(currentUpload); //Upload File aufrufen
    } 
}

function handleComplete(event){ //Wenn File fertig soll nächster Upload starten
    totalProgress += currentUpload.size; //Fügt aktuelle Filesize zum Gesamtfortschritt hinzu
    startNextUpload(); //Nächsten Upload starten
}
    
function handleError(event){ //Gibt Fehlermeldungen aus
    alert("Upload failed"); //Fehlermeldung
    totalProgress += currentUpload.size; //Datei zum Progress hinzufügen, damit Fortschritt stimmt
    startNextUpload(); //Nächsten Upload starten
}
    
function handleProgress(event){ //Gibt den Fortschritt an
    var progress = totalProgress + event.loaded; //Fortschritt des aktuellen Uploads zum gesamtfortschritt hinzufügen
    document.getElementById('progress').innerHTML = 'Current Progress:' + (progress/totalSize) + '%';
}


function uploadFile(){ //Lädt Datei auf Server
    var xhr= new XMLHttpRequest(); // AJAX Request ???
    xhr.open('POST', '/Scripts/upload.php'); //URL und Requesttyp angeben
    
    var formdata = new FormData(); //FormData Objekt zum versenden der Datei
    formdata.append('uploadfile', file); //Anhängen der Datei an das Objekt
    xhr.send(formdata); //senden des Requests
    
    
    xhr.upload.addEventListener("progress", handleProgress); //Eventlistener Progress
    xhr.addEventListener("load", handleComplete) //EventListerner um nächsten Fileupload zu starten
    xhr.addEventListener("error", handleError) //EventListener für Errors beim Upload
    
}


