@include('layouts.Inicio')
<div id="app" class="container-fluid">
      <div class="card">
            <div class="card-header">
                Registrar Escuela
            </div>
            <div class="card-body">
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
                <form id="formulario_escuela" action="{{route('guardar_escuela')}}" method="post" enctype="multipart/form-data">
                  @csrf  
                  <div class="form-group">
                        <label for="escuela">Nombre de la escuela</label>
                        <input type="text" class="form-control" id="escuela" name="escuela" required/>
                        {!! $errors->first('escuela','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required/>
                        {!! $errors->first('direccion','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                    </div>
                    <div class="form-group">
                          <label for="imagen">Imagen de la escuela</label> 
                          <input type="file" name="imagen" id="imagen" class="form-control" required/>
                          {!! $errors->first('imagen','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                    </div>
                    <input type="submit" value="Guardar" class="btn btn-outline-primary">
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOMBRE DE LA ESCUELA</th>
                            <th scope="col">DIRECCION</th>
                            <th scope="col">IMAGEN</th>
                            <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                              @forelse ($Escuelas as $key => $item)
                                    <tr>
                                          <td>{{$key+1}}</td>
                                          <td>{{$item->nombre_escuela}}</td>
                                          <td>{{$item->direccion}}</td>
                                          @if ($item->rutaimagen !== "")
                                            <td><img src="{{Storage::url($item->rutaimagen)}}" alt="" width="70vh"></td>    
                                          @else
                                            <td>No hay imagen</td>
                                          @endif
                                          
                                          <td>
                                              <button class="btn btn-outline-success" onclick="asignar({{$item->id}});">Asignar</button>
                                            <button title="Editar escuela" class="btn btn-outline-primary" onclick="Editar({{$item->id}});"><i class="fa fa-edit"></i></button>
                                            <button title="Eliminar escuela" class="btn btn-outline-danger" onclick="Eliminar({{$item->id}});">x</button>
                                          </td>
                                    </tr>   
                              @empty
                                  <tr>
                                        <td>
                                              No hay registros
                                        </td>
                                  </tr>
                              @endforelse
                        </tbody>
                    </table>
                </div>
</div>


<!-- Modal -->
<div class="modal" id="editarEscuela">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ediatar Escuela</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="formulario_escuela" action="{{route('updateEscuela')}}" method="post" enctype="multipart/form-data">
                @csrf  
                <input type="hidden" name="idEscuela" id="idescuela">
                <div class="form-group">
                      <label for="escuela">Nombre de la escuela</label>
                      <input type="text" class="form-control" id="escuelaeditar" name="escuelaeditar" required/>
                      {!! $errors->first('escuelaeditar','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                  </div>
                  <div class="form-group">
                      <label for="direccion">Direccion</label>
                      <input type="text" class="form-control" id="direccionediatra" name="direccionediatra" required/>
                      {!! $errors->first('direccionediatra','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                  </div>
                  <div class="form-group">
                        <label for="imagen">Imagen de la escuela</label> 
                        <input type="file" name="imageneditar" id="imageneditar" class="form-control" />
                        {!! $errors->first('imageneditar','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
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
{{-- eliminar  --}}
  <div class="modal " id="eliminarEscuela" >
    <div class="modal-dialog">
      <div class="modal-content" style="background: red;">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Eliminar Escuela</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeEliminar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>Esta seguro de eliminar la escuela ? </p>
        <form action="{{route('eliminarEs')}}" method="post">
            @csrf
            <input type="hidden" name="escuelaid" id="escuelaid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="closeEliminar1">Canselar</button>
          <button type="submit" class="btn btn-primary" id="eliminar">Eliminar</button>
        </form>
       </div>
      </div>
    </div>
  </div>

@include('layouts.final')
<script src="{{asset('js/Escuela.js')}}"></script>
