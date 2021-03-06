$(document).ready(function() {
   $('#informacion').show();
   $('#informacion').hide(2000);
});

$('#archivoinfo').click(function(){
	$('#informacion').show();
});

$("#closeinfo").click(function(){
	$("#informacion").hide(3000);
});