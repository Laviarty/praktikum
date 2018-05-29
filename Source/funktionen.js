
function zeigeErgebnisse(){
	$.post("bilderAnzeigen.php", function(data){
		$("#imagesKlein").html(data);
	});
}

function showTable(){
    
    var geneId = document.getElementById("geneId").value;//$('search').serialize();
    var genename=document.getElementById("genename").value;
    var hoch=document.getElementById("hoch").value;
    var runter=document.getElementById("runter").value;

    if(document.getElementById("inlineCheckbox1").checked){
        var rma=document.getElementById("inlineCheckbox1").value;
    }
    if(document.getElementById("inlineCheckbox2").checked){
        var mas=document.getElementById("inlineCheckbox2").value;
    }
    
    var formvalues= [geneId,genename,hoch,runter,rma,mas];
    
    //document.getElementById('testing').innerHTML = formvalues;
    
	$.post("table.php?values="+formvalues, function(data){
		$("#datatable").html(data);
	})
}
			  
function download(){
	$.post("download.php", function(data){});
}

function goto(){
	$('#menu1').tab('show');
}
									
function deleteFiles(){
                              $.post("delete.php");
							 return false;
						  }

function readselect(){
                            var type = $('form').serialize();
                            var type2 = type.replace(/&|select=/gi, "");
                
                            //document.getElementById('runinfo').innerHTML = type2;
                
                            window.location.href = "Scripts/Ranalyse.php?name=" + type2;
							$('#menu2').tab('show');
                        }