let editar=(id,temario,numeropreguntas)=>{
$('#idtema').val(id);
$('#temaeditar').val(temario);
$('#numeroeditar').val(numeropreguntas);
$('#editarMateria').show('swing');
}
$('#close').click(function(){
    $('#editarMateria').hide('swing');
});

$('#close1').click(function(){
    $('#editarMateria').hide('swing');
});
