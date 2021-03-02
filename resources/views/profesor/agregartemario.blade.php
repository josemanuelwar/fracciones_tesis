@include('layouts.Inicio')
<div id="app" class="container-fluid">
       <br>
       <div class="card">
              @if($message = Session::get('success'))
                     <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                     </div>
              @endif
              @if ($message = Session::get('danger'))
                     <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                     </div>
              @endif
              <div class="card-header">Temario</div>
              <div class="card-body">      
                     <form  method="post" action="{{route('guardarTemas')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                   <label for="tema">Nombre del tema</label>
                                   <input type="text" class="form-control" id="tema" name="tema"  placeholder="aprendiendo fraciones" required>
                                   {!! $errors->first('tema','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                            </div>
                            <div class="form-group">
                            <label for="grado">Seleciona un materia</label>
                            <select class= "form-control" name="materia" id="materia" required>
                                   @forelse ($materias as $item)
                                       <option value="{{$item->id}}">{{$item->nombremateria}}--{{$item->nombregrado}}</option>
                                   @empty
                                       <option value="0">No hay datos</option>
                                   @endforelse
                            </select>   
                            {!! $errors->first('materia','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                            </div>
                            <div class="form-group">
                            <label for="numero">Ingresa el numero de preguntas</label>
                            <input type="number" name="numero" class="form-control" max="100" min="1" required/>
                            {!! $errors->first('numero','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                            </div>
                            <div class="form-group">
                                   <label for="viedo">Subir video</label>
                                   <input type="file" name="video" id="video" class="form-control">
                                   {!! $errors->first('video','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}       
                            </div>
                            {{-- <button type="button">Trasmicion en vivo</button> --}}
                            <input type="submit" value="Guardar" class="btn btn-outline-primary">
                     </form>    
              <hr>
                     <div class="table-responsive">
                            <table class="table table-bordered">
                                   <thead>
                                   <tr>
                                          <th scope="col">Grado</th>
                                          <th scope="col">Temario</th>
                                          <th scope="col">Numero pregunta</th>
                                          <th scope="col">Acciones</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                          @forelse ($temas as $item)
                                          <tr>
                                                 <td>
                                                        {{$item->nombregrado}}
                                                 </td>
                                                 <td>
                                                        {{$item->nombre_tema}}
                                                 </td>
                                                 <td>
                                                        {{$item->numerodepreguntas}}
                                                 </td>
                                                 <td>
                                                        <a href="{{route('temas1',$item->id)}}" class="btn btn-outline-success">Agregar preguntas</a>
                                                        <button title="Ediatar tema" class="btn btn-outline-primary" onclick="editar({{$item->id}},'{{$item->nombre_tema}}',{{$item->numerodepreguntas}});"><i class="fa fa-edit"></i></button>
                                                 </td>
                                          </tr>
                                              
                                          @empty
                                                 <tr>
                                                        <td>
                                                               No hay datos
                                                        </td>
                                                 </tr>
                                          @endforelse
                                   </tbody>
                            </table>
                     </div>    
              </div>
       </div>          
</div>
<!-- Modal -->
<div class="modal" id="editarMateria">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="staticBackdropLabel">Ediatar Temas</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
              <form action="{{route('temaeditar')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   <input type="hidden" name="idtema" id="idtema">
                   <div class="form-group">
                     <label for="tema">Nombre del tema</label>
                     <input type="text" class="form-control" id="temaeditar" name="temaeditar"  placeholder="aprendiendo fraciones" required>
                     {!! $errors->first('temaeditar','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
              </div>
              <div class="form-group">
              <label for="grado">Seleciona un materia</label>
              <select class= "form-control" name="materiaeditar" id="materiaeditar" required>
                     @forelse ($materias as $item)
                         <option value="{{$item->id}}">{{$item->nombremateria}}--{{$item->nombregrado}}</option>
                     @empty
                         <option value="0">No hay datos</option>
                     @endforelse
              </select>   
              {!! $errors->first('materiaeditar','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
              </div>
              <div class="form-group">
              <label for="numero">Ingresa el numero de preguntas</label>
              <input type="number" name="numeroeditar" id="numeroeditar" class="form-control" max="100" min="1" required/>
              {!! $errors->first('numeroeditar','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
              </div>
              <div class="form-group">
                     <label for="viedo">Subir video</label>
                     <input type="file" name="videoeditar" id="videoeditar" class="form-control">
                     {!! $errors->first('videoeditar','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}       
              </div>     
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-danger" data-dismiss="modal" id="close1">Canselar</button>
             <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
           </form>
           </div>
         </div>
       </div>
     </div>




@include('layouts.final')
{{-- <script src="{{asset('js/app.js')}}"></script> --}}
<script src="{{asset('js/temario.js')}}"></script>