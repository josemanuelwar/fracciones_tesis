@include('layouts.Inicio')
<div id="app" class="container-fluid">
    <br>
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
           <h1>Preguntas</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('guardarpreguntas')}}">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="idTema" value="{{$temas[0]['id']}}">
                    <label for="tema">Nombre Tema</label>
                    <input class="form-control" type="text" name="tema" id="tema" value="{{$temas[0]['nombre_tema']}}" readonly>
                </div>
                <div class="form-group">
                    <label for="numero">Numero preguntas</label>
                    <input class="form-control" type="text" name="" id="" value="{{$temas[0]['numerodepreguntas']}}" readonly>
                    <input type="hidden" name="numero" value="{{$temas[0]['numerodepreguntas']}}">
                </div>
                <div class="form-group">
                    <label for="pergunta">Ingresa la preguata</label>
                    <textarea name="preguntas" id="preguntas" cols="10" rows="10" class="form-control" required maxlength="500" minlength="10" autofocus>
                        {{old('preguntas')}}
                    </textarea>
                    {!! $errors->first('preguntas','<br><small id="nombreHelp6" class="alert alert-danger">:message</small>') !!}
                </div>
                <div class="form-group">
                    <label for="nivel">Seleciona el nivel</label>
                    <select name="nivel" id="nivel" class="form-control" required>
                        <option value="facil">FACIL</option>
                        <option value="medio">MEDIO</option>
                        <option value="dificil">DIFICIL</option>
                    </select>
                    {!! $errors->first('nivel','<br><small id="nivelHelp6" class="alert alert-danger">:message</small>') !!}
                </div>
                <input type="submit" value="Guardar" class="btn btn-outline-primary">
            </form>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Preguntas</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($preguntas != null)
                        @foreach ($preguntas as $item)
                            <tr>
                                <td>
                                    {!! $item['reactivo'] !!}
                                </td>
                                <td>
                                    <a href="/Respuestas/{{$item['id']}}" class="btn btn-outline-success">Agregar respuesta</a>
                                    <a href="{{route('Vistaprevia',$item['id'])}}" target="_blank" class="btn btn-outline-info">vista previa</a>
                                    <a href="{{route('Editarpreguntas',$item['id'])}}" class="btn btn-outline-primary">Editar</a>
                                    {{-- <button class="btn btn-outline-danger">Eliminar</button> --}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>No hay datos</td>
                        </tr>    
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- <pregunta-component></pregunta-component> --}}
</div>    
@include('layouts.final')
<script>
    var icon="{{asset('js/nicEditorIcons.gif')}}";
</script>
{{-- <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> --}}
<script src="{{asset('js/nicEdit.js')}}"></script>
<script>
    //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
</script>
{{-- <script src="{{asset('js/app.js')}}"></script> --}}