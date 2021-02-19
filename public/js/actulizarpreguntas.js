'use strict'
window.addEventListener('load',function(){
    const formu=document.querySelector("#actulisar");
    formu.addEventListener('submit',function(){
        let preguntas=document.getElementById('preguntas').value;
        let nivel=document.getElementById('nivel').value;
        let incisos =document.getElementsByName('inciso');
        let correcta=[];
        for (let index = 0; index < incisos.length; index++) {
            if(incisos[index].checked===true){
                correcta.push(1);
            }else{
                correcta.push(0);
            }
        }        
        let respuestas={
            respuestaA:document.getElementById('respuestaA').value,
            idrespuestaA:document.getElementById('idrespuestaA').value,
            respuestaB:document.getElementById('respuestaB').value,
            idrespuestaB:document.getElementById('idrespuestaB').value,
            respuestaC:document.getElementById('respuestaC').value,
            idrespuestaC:document.getElementById('idrespuestaC').value,
            respuestaD:document.getElementById('respuestaD').value,
            idrespuestaD:document.getElementById('idrespuestaD').value
        }
        let pregut={
            idpregunta:document.getElementById('idpregunta').value,
            pregunsta:preguntas,
            nivel:nivel,
        }
        if(preguntas.trim()==null){
            console.log("error");
        }else if(nivel.trim()==null){
            console.log("error");
        }else if(respuestas.length > 0)
        {
            console.log("error")
        }else{
            let url ="/Actualisapre";
            let json={
                respuest:respuestas,
                preguntas:pregut,
                respuestacorecta:correcta
            }
            fetch(url,{
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),  
                  'Content-Type': 'application/json'
                  // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: JSON.stringify(json) // body data type must match "Content-Type" header
            }).then(response => response.json()).catch(error=>{
                console.log(error);
            }).then(response=>{
                console.log(response);
            });          
        }
    });
});