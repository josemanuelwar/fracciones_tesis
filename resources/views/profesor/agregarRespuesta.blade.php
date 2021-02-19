@include('layouts.Inicio')
<div id="app" class="container-fluid">
    <div id="buena" class="alert alert-success alert-block" style="display: none">
        <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>Se ha gauradado correctamente las respuesta</strong>
    </div>
    <div class="card">
        <div class="card-header">
            {!! $pregunta[0]['reactivo'] !!}
        </div>
        <div class="card-body">
            <h4>ingresa las respuestas y marca la correcta</h4>
            <form id="formulario" action=""  method="post" onsubmit="return false;">
                @csrf
                <div class="row">
                    <input type="hidden" name="idpregunta" id="idpregunta" value="{{$pregunta[0]['id']}}">
                    <div class="col-xl-6 col-md-6">
                        <label for="inciso">A</label>
                        <input type="radio" name="inciso" id='inciso'>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <textarea name="respuesta" id="respuestaA" cols="30" rows="10" class="form-control" ></textarea>
                    </div>
                    <hr>
                    <div class="col-xl-6 col-md-6">
                        <label for="inciso">B</label>
                        <input type="radio" name="inciso" id='inciso'>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <textarea name="respuesta" id="respuestaB" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <hr>
                    <div class="col-xl-6 col-md-6">
                        <label for="inciso">C</label>
                        <input type="radio" name="inciso" id='inciso'>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <textarea name="respuesta" id="respuestaC" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <hr>
                    <div class="col-xl-6 col-md-6" >
                        <label for="inciso">D</label>
                        <input type="radio" name="inciso" id='inciso'>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <textarea name="respuesta" id="respuestaD" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <input type="submit" class="btn btn-outline-primary" value="Guardar">
            </form>
        </div>
    </div>
    
</div>
@include('layouts.final')
<script src="{{asset('js/respuestas.js')}}"></script>
<script>
    var icon="{{asset('js/nicEditorIcons.gif')}}";
</script>
<script src="{{asset('js/nicEdit.js')}}"></script>
<script>
    //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
</script>
