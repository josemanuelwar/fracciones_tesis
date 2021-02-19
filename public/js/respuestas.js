'use strict'
window.addEventListener('load', function () {
    let formulario= document.querySelector("#formulario");
    formulario.addEventListener('submit',function () {
        let respuesta=[];
        respuesta.push(document.getElementById('respuestaA').value);
        respuesta.push(document.getElementById('respuestaB').value);
        respuesta.push(document.getElementById('respuestaC').value);
        respuesta.push(document.getElementById('respuestaD').value);
        let incisos=document.getElementsByName('inciso');
        let insisos=[];
        for (let index = 0; index < incisos.length; index++) {
            if(incisos[index].checked===true){
                insisos.push(1);
            }else{
                insisos.push(0);
            } 
        }
        let json={
            respuestas:respuesta,
            incisos:insisos,
            idpregunta:document.getElementById('idpregunta').value
        };
        let url="/GurdarRespuesta"
        fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),  
              'Content-Type': 'application/json'
              // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: JSON.stringify(json) // body data type must match "Content-Type" header
        }).then( response => response.json()).catch(error=>{
              console.log(error);
        }).then(response =>{
            if(response==true){
                limpiar();
                alerta();
            }
        });
    });
    const limpiar= () =>{
        document.getElementById('respuestaA').value=" ";
        document.getElementById('respuestaB').value=" ";
        document.getElementById('respuestaC').value=" ";
        document.getElementById('respuestaD').value=" ";
    }
    const alerta = () =>{
        document.getElementById('buena').style.display='block';
    }
});