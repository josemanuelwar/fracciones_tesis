@include('layouts.Inicio')
<div id="app" class="container-fluid">
    <br>
    <div class="card">
        <div class="card-header">
           <h1>Preguntas</h1>
        </div>
        <div class="card-body">
            <form method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="" value="{{$temas[0]['id']}}">
                    <label for="tema">Nombre Tema</label>
                    <input class="form-control" type="text" name="tema" id="tema" value="{{$temas[0]['nombre_tema']}}" readonly>
                </div>
                <div class="form-group">
                    <label for="numero">Numero preguntas</label>
                    <input class="form-control" type="text" name="" id="" value="{{$temas[0]['numerodepreguntas']}}" readonly>
                </div>
                <div class="form-group">
                    <label for="pergunta">Ingresa la preguata</label>
                    <textarea name="preguntas" id="preguntas" cols="10" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="nivel">Seleciona el nivel</label>
                    <select name="nivel" id="nivel">
                        <option value="facil">FACIL</option>
                        <option value="medio">MEDIO</option>
                        <option value="dificil">DIFICIL</option>
                    </select>

                </div>
                <input type="submit" value="Guardar" class="btn btn-outline-primary">
            </form>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Tema</th>
                    <th scope="col">Preguntas</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
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