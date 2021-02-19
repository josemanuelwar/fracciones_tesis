@include('layouts.alumnoin')
<article class="about">
    <div id="preguntas"></div>
    <div id='respuesta'></div>
    <div>
        <button id="anterior">Anterior</button>
        <button id="siguiente">Siguiente</button>
    </div>

</article>    
@include('layouts.alumnofin')
<script>
    var idtema={{$idtemario}};
</script>
<script src="{{asset('js/preguntas.js')}}"></script>