$(function() {
   console.log("holas"); 
});

$( "#formulario_escuela" ).submit(function( event ) {
    event.preventDefault();
    let nombre=$("#escuela").val();
    let direccion=$("#direccion").val();
    if(nombre.trim() == null || nombre.trim().length == 0){
        console.log("error");
    }else if(direccion.trim() == null || direccion.trim().length == 0){
        console.log("erro");
    }else{
        let json={
            'nombre_escuela':nombre,
            'direccion':direccion,
            "_token": $("meta[name='csrf-token']").attr("content")
        }
        enviar(json);
    }
});

let enviar=(json)=>{
    let url=$('#formulario_escuela').attr('action');
    let method=$('#formulario_escuela').attr('method');
    $.ajax({
        type: method,
        url: url,
        data: json,
        dataType:'json',
        success: function(item) {
            console.log(item);
        },
        error:function (Error) {
            console.log("error");
        }
      });
}
