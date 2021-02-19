'use strict'
var preguntas=[];
var respuestas=[];
var i=0, j=1;
window.addEventListener('load',function(){
    let idtemas=idtema;
    let url="/preguntasa_jax/"+idtemas;
    fetch(url,{
        method: 'GET', // *GET, POST, PUT, DELETE, etc.
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),  
        'Content-Type': 'application/json'
        // 'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then( response => response.json()).catch(error=>{
        console.log(error);
  }).then(response =>{
      preguntas=response;
    mostrapreguntas(i,j);
});
let mostrapreguntas=(i,j)=>{
    let plantilla='<div><h5>Problema'+j+'</h5><p>'+preguntas[i].reactivo+'</p></div>';
    document.getElementById('preguntas').innerHTML=plantilla;
    
    let url='/respuestas_ajax/'+preguntas[i].id;
    fetch(url,{
        method: 'GET', // *GET, POST, PUT, DELETE, etc.
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),  
        'Content-Type': 'application/json'
        // 'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then( response => response.json()).catch(error=>{
        console.log(error);
    }).then(response =>{
       respuestas=response;
       mostrarrespuestas();
    });    
}

let mostrarrespuestas=()=>{
    let incisos=['0','A','B','C','D'];
    let i=0;
    let platilla = respuestas.map(elemneto =>{
        i++;
        return "<div><table><td>"+incisos[i]+" )<input type='radio' value='"+elemneto.id
        +"' name='respuesta'></td><td>"+elemneto.respuesta+"</td></table></div>";
        
    });
    document.getElementById('respuesta').innerHTML=platilla;
    // console.log(platilla);
}

let siguientes = document.getElementById('siguiente');
    siguientes.addEventListener('click',function(){
        mostrapreguntas(i++,j++);        
    });

let anterior = document.getElementById('anterior');
    anterior.addEventListener('click',function(){
        mostrapreguntas(i--,j--);
    });    
});

