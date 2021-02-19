@include('layouts.Inicio')
<div id="app" class="container-fluid">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Editar Preguntas</h1>
        </div> 
        <div class="card-body">
            <form id="actulisar" method="post" action="{{route('actualizas-preguntas')}}" onsubmit="return false;">
                @csrf
                <div class="form-group">
                    <label for="pergunta">Ingresa la preguata</label>
                    <input type="hidden" name="idpregunta" id="idpregunta" value="{{$pregunta[0]['id']}}">
                    <textarea name="preguntas" id="preguntas" cols="10" rows="10" class="form-control" required maxlength="500" minlength="10" autofocus>
                        {{$pregunta[0]['reactivo']}}
                    </textarea>
                    {!! $errors->first('preguntas','<br><small id="nombreHelp6" class="alert alert-danger">:message</small>') !!}
                </div>
                <div class="form-group">
                    <label for="nivel">Seleciona el nivel</label>
                    <select name="nivel" id="nivel" class="form-control" required>
                        @if ($pregunta[0]['nivel']=='facil')
                            <option value="facil" selected>FACIL</option>    
                        @else
                            <option value="facil">FACIL</option>
                        @endif
                        @if ($pregunta[0]['nivel']=='medio')
                            <option value="medio" selected>MEDIO</option>    
                        @else
                            <option value="medio">MEDIO</option>
                        @endif
                        @if ($pregunta[0]['nivel']=='dificil')
                            <option value="dificil" selected>DIFICIL</option>    
                        @else
                            <option value="dificil">DIFICIL</option>
                        @endif
                    </select>
                    {!! $errors->first('nivel','<br><small id="nivelHelp6" class="alert alert-danger">:message</small>') !!}
                </div>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <input type="hidden" name="idrespuestaA" id="idrespuestaA" value="{{$respuestas[0]['id']}}">
                        <label for="inciso">A</label>
                        @if ($respuestas[0]['corecta']===1)
                            <input type="radio" name="inciso" id='inciso' checked>
                        @else
                            <input type="radio" name="inciso" id='inciso'>    
                        @endif
                        
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <textarea name="respuesta" id="respuestaA" cols="30" rows="10" class="form-control" >
                            {{$respuestas[0]['respuesta']}}
                        </textarea>
                    </div>
                    <hr>
                    <div class="col-xl-4 col-md-6">
                        <label for="inciso">B</label>
                        <input type="hidden" name="idrespuestaB" id="idrespuestaB" value="{{$respuestas[1]['id']}}">
                        @if ($respuestas[1]['corecta']===1)
                            <input type="radio" name="inciso" id='inciso' checked>    
                        @else
                            <input type="radio" name="inciso" id='inciso'>
                        @endif
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <textarea name="respuesta" id="respuestaB" cols="30" rows="10" class="form-control">
                            {{$respuestas[1]['respuesta']}}
                        </textarea>
                    </div>
                    <hr>
                    <div class="col-xl-4 col-md-6">
                        <label for="inciso">C</label>
                        <input type="hidden" name="idrespuestaC" id="idrespuestaC" value="{{$respuestas[2]['id']}}">
                        @if ($respuestas[2]['corecta']===1)
                            <input type="radio" name="inciso" id='inciso' checked>    
                        @else
                            <input type="radio" name="inciso" id='inciso'>
                        @endif
                        
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <textarea name="respuesta" id="respuestaC" cols="30" rows="10" class="form-control">
                            {{$respuestas[2]['respuesta']}}
                        </textarea>
                    </div>
                    <hr>
                    <div class="col-xl-4 col-md-6" >
                        <label for="inciso">D</label>
                        <input type="hidden" name="idrespuestaD" id="idrespuestaD" value="{{$respuestas[3]['id']}}">
                        @if ($respuestas[3]['corecta']===1)
                            <input type="radio" name="inciso" id='inciso' checked>    
                        @else
                            <input type="radio" name="inciso" id='inciso'>
                        @endif
                        
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <textarea name="respuesta" id="respuestaD" cols="30" rows="10" class="form-control">
                            {{$respuestas[3]['respuesta']}}
                        </textarea>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn btn-outline-primary">
            </form>
        </div>
    </div>    
</div>
@include('layouts.final')
<script src="{{asset('js/actulizarpreguntas.js')}}"></script>
<script>
    var icon="{{asset('js/nicEditorIcons.gif')}}";
</script>
<script src="{{asset('js/nicEdit.js')}}"></script>
<script>
    //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
</script>