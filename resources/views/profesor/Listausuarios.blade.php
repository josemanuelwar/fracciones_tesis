@include('layouts.Inicio')
<div id="app" class="container-fluid">
      <br>
      <div class="card">
            <div class="card-header">Lista de alumnos</div>
    
            <div class="card-body">
               <div class="table-responsive"> 
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO PATERNO</th>
                        <th scope="col">APELLIDO MATERNO</th>
                        <th scope="col">DIRECCION</th>
                        <th scope="col">ESCUELA</th>
                        <th scope="col">CORREO ELECTRONICO</th>
                        <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alumnos as $item)
                              <tr>
                                    <td>
                                          {{$item->nombrecompleto}}  
                                    </td>
                                    <td>
                                          {{$item->apellido_paterno}}
                                    </td>
                                    <td>
                                          {{$item->apellido_materno}}
                                    </td>
                                    <td>
                                          {{$item->direccion}}
                                    </td>
                                    <td>
                                          {{$item->nombre_escuela}}
                                    </td>
                                    <td>
                                          {{$item->email }}
                                    </td>
                                    <td>
                                          <a href="{{route('EditarAlum',$item->id)}}" class="btn btn-outline-primary" title="Editar usuario"><i class="fa fa-edit"></i></a>
                                          <button class="btn btn-outline-danger" title="Eliminar usuario">x</button>
                                    </td>
                              </tr>
                            
                        @empty
                            <tr>
                                  <td>
                                        No hay datos cargados 
                                  </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-felx justify-content-center">
                    {!! $alumnos->links() !!}
                </div>
            </div>        
            </div>
        </div>
</div>
@include('layouts.final')
{{-- <script src="{{asset('js/app.js')}}"></script> --}}