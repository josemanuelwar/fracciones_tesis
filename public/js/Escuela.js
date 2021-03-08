let Editar=(id)=>{
    escuela(id);
    $('#editarEscuela').show('swing');

}

$('#close').click(function(){
    $('#editarEscuela').hide('swing');
});

$('#close1').click(function(){
    $('#editarEscuela').hide('swing');
});

let escuela=(id)=>{
    $.ajax({
        method:'GET',
        url:'/GetEscuela/'+id,
        dataType:'json',
        success:function(item){
            mostar(item);
        },
        error:function(error){
            console.log(error);
        }
    });

}
let mostar=(data)=>{
    $('#escuelaeditar').val(data.nombre_escuela);
    $('#direccionediatra').val(data.direccion);
    $('#idescuela').val(data.id);
}

let Eliminar=(id)=>{
    $('#escuelaid').val(id);
    $('#eliminarEscuela').show('swing');
}

$('#closeEliminar').click(function(){
   $('#eliminarEscuela').hide('swing'); 
});

$('#closeEliminar1').click(function(){
    $('#eliminarEscuela').hide('swing');
});

let asignar=(id)=>{
    $.ajax({
        method:'GET',
        url:'/AsignarEscuela/'+id,
        dataType:'json',
        success:function(item){
            mostar(item);
        },
        error:function(error){
            console.log(error);
        }
    });
}