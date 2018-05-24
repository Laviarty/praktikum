
function zeigeErgebnisse(){
	$.post("bilderAnzeigen.php", function(data){
		$("#imagesKlein").html(data);
	});
}

function showTable(){
	$.post("table.php", function(data){
		$("#datatable").html(data);
	});
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
                
                            document.getElementById('runinfo').innerHTML = type2;
                
                            window.location.href = "Scripts/Ranalyse.php?name=" + type2;
							$('#menu2').tab('show');
                        }