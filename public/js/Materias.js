let editar=(id,nombre,siglas,aterior)=>{
    $('#editarMateria').show('swing');
    $('#idmateria').val(id);
    $('#materiaeditar').val(nombre);
    $('#abrebiaturaeditar').val(siglas);
    $('#idateriorgra').val(aterior);
    // $('#ruta').val(ruta);
}

$('#close').click(function(){
    $('#editarMateria').hide('swing');
});

$('#close1').click(function(){
    $('#editarMateria').hide('swing');
});

let eliminar=(id)=>{
    $('#eliminarMateria').show('swing');
    $('#materiaid').val(id)
}

$('#closeEliminar').click(function(){
    $('#eliminarMateria').hide('swing');
});

$('#closeEliminar1').click(function(){
    $('#eliminarMateria').hide('swing');
});