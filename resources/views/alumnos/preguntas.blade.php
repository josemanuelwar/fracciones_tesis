@include('layouts.alumnoin')
<article class="about">
    <div id="preguntas"></div>
    <div id='respuesta'></div>
    <div>
        <button id="anterior" class="btn btn-light"><img src="{{asset('images/icon/anterior.png')}}" class="img-thumbnail" style="width:80px; margin-left:80px;" alt=""></button>
        <button id="siguiente" class="btn btn-light"><img src="{{asset('images/icon/siguiente.png')}}" class="img-thumbnail" style="width:80px" alt=""></button>
    </div>

</article>    
@include('layouts.alumnofin')
<script>
    var idtema={{$idtemario}};
</script>
<script src="{{asset('js/preguntas.js')}}"></script>