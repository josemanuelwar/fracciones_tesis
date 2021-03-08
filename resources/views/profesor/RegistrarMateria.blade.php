@include('layouts.Inicio')
<div id="app">
<br>
<div class="card">
        <div class="card-header">
            Agragar materias
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
            @endif
            @if ($message=Session::get('danger'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            <form action="{{route('GuardarMateria')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="materia" >Nombre de la materia</label>
                    <input type="text" name="materia" id="materia" class="form-control"  required maxlength="20" minlength="2"/>
                    {!! $errors->first('materia','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                    <label for="abrebiatura">Abreviatura de la materia</label>
                    <input type="text" name="abrebiatura" id="abrebiatura" class="form-control"  required maxlength="4" minlength="2"/>
                    {!! $errors->first('abrebiatura','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                    <label for="listagardos">Selecciona el gardo</label>
                    <select name="listagardos" id="listagardos" class="form-control" required>
                      @forelse ($grados as $item)
                          <option value="{{$item->id}}">{{$item->nombregrado}}</option>
                      @empty
                          <option value="0">No hay informacion</option>
                      @endforelse
                    </select>
                    {!! $errors->first('listagardos','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                    <label for="imagen">Seleccionar una portada</label>
                    <input type="file" name="imagen" id="imagen" class="form-control">
                    {!! $errors->first('imagen','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                </div>
                <input type="submit" value="Guardar" class="btn btn-outline-primary" required>
            </form>

            <hr>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th scope="col">MATERIA</th>
                        <th scope="col">ABREVITURA</th>
                        <th scope="col">GRADO</th>
                        <th scope="col">PORTADA</th>
                        <th scope='col' >ACCIONES</th>
                    </thead>
                    <tbody>
                        @forelse ($lista as $item)
                            <tr>
                                <td>
                                    {{$item->nombremateria}}
                                </td>
                                <td>
                                    {{$item->siglasmaterias}}
                                </td>
                                <td>
                                    {{$item->nombregrado}}
                                </td>
                                @if ($item->urlimagenmat != null)
                                    <td>
                                        <img src="{{Storage::url($item->urlimagenmat)}}" alt="" width="70vh">
                                    </td>
                                @else
                                    <td>No hay portada </td>
                                @endif
                                <td>
                                    <button title="Editar Materia" class="btn btn-outline-primary" onclick="editar({{$item->id}},'{{$item->nombremateria}}','{{$item->siglasmaterias}}',{{$item->grados_id}},'{{$item->urlimagenmat}}');"><i class="fa fa-edit"></i></button>
                                    <button title="Eliminar Materia" class="btn btn-outline-danger" onclick="eliminar({{$item->id}},);">x</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>no hay elemetos guardados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                 <div class="d-felx justify-content-center">
                    {!! $lista->links() !!}
                 </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal" id="editarMateria">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ediatar Materia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('ActulizaMateria')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="idmateria" id="idmateria">
                    <input type="hidden" name="idateriorgra" id="idateriorgra">
                    <input type="hidden" name="ruta" id="ruta">
                    <label for="materia" >Nombre de la materia</label>
                    <input type="text" name="materiaeditar" id="materiaeditar" class="form-control"  required maxlength="20" minlength="2"/>
                    {!! $errors->first('materiaeditar','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                    <label for="abrebiatura">Abreviatura de la materia</label>
                    <input type="text" name="abrebiaturaeditar" id="abrebiaturaeditar" class="form-control"  required maxlength="4" minlength="2"/>
                    {!! $errors->first('abrebiaturaeditar','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                    <label for="listagardos">Selecciona el gardo</label>
                    <select name="listagardoseditar" id="listagardoseditar" class="form-control" required>
                      @forelse ($grados as $item)
                          <option value="{{$item->id}}">{{$item->nombregrado}}</option>
                      @empty
                          <option value="0">No hay informacion</option>
                      @endforelse
                    </select>
                    {!! $errors->first('listagradoseditar','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                    <label for="imagen">Seleccionar una portada</label>
                    <input type="file" name="imageneditar" id="imageneditar" class="form-control">
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
  <div class="modal " id="eliminarMateria" >
    <div class="modal-dialog">
      <div class="modal-content" style="background: red;">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Eliminar materia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeEliminar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>Esta seguro de eliminar la Materia ? </p>
        <form action="{{route('Materiaselimnar')}}" method="post">
            @csrf
            <input type="hidden" name="materiaid" id="materiaid">
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
{{-- <script src="{{asset('js/app.js')}}"></script> --}}
<script src="{{asset('js/Materias.js')}}"></script>