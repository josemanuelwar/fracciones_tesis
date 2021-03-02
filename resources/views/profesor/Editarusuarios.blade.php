@include('layouts.Inicio')
<div class="container-fluid">
    <br>
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="card">
        <h5 class="card-header">Editar de Alumnos</h5>
        <div class="card-body">
            <form method="POST" action="{{route('actulizar_alumnos')}}">
                @csrf
                <input type="hidden" name="id" value="{{$id}}"/>
                <div class="form-group">
                    <label for="nombre">Nombre del alumno</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" placeholder="Ingresa el nombre" value="{{old('nombre',$alumnos[0]->nombrecompleto)}}"/>   
                    {!! $errors->first('nombre','<br><small id="nombreHelp6" class="alert alert-danger">:message</small>') !!}
                </div>
                <div class="form-group">
                    <label for="app">Apellido Paterno</label>
                    <input type="text" class="form-control" id="app" name="app" aria-describedby="appHelp" placeholder="Ingresa el nombre" value="{{old('app',$alumnos[0]->apellido_paterno)}}" />
                    {!! $errors->first('app','<br><small id="appHelp5" class="alert alert-danger">:message</small>')!!}
                </div>
                <div class="form-group">
                    <label for="apm">Apellido Materno</label>
                    <input type="text" class="form-control" id="apm" name="apm" aria-describedby="apmHelp" placeholder="Ingresa el nombre" value="{{old('apm',$alumnos[0]->apellido_materno)}}" />
                    {!! $errors->first('apm','<br><small id="appHelp4" class="alert alert-danger">:message</small>')!!}
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="direccionHelp" placeholder="Ingresa el nombre" value="{{old('direccion',$alumnos[0]->direccion)}}"/>
                    {!! $errors->first('direccion','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                </div>
                <div class="form-group">
                    <label for="escuela">Seleciona la escuela</label>
                    <select name="escuela" id="escuela" class="form-control">
                        @if($escuelas !== null)
                            @foreach($escuelas as $value)
                                @if($alumnos[0]->escuelas_id == $value->id)
                                    <option value="{{$value->id}}" selected>{{$value->nombre_escuela}}</option>
                                @else    
                                    <option value="{{$value->id}}">{{$value->nombre_escuela}}</option>
                                @endif
                            @endforeach    
                        @else
                            <option value="">no hay Escuela asignado </option>
                        @endif
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Correo Electronico</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{old('email',$alumnos[0]->email)}}"/>
                    {!! $errors->first('email','<br><small id="appHelp1" class="alert alert-danger">:message</small>')!!}
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password1" placeholder="Password" >
                    <!-- {!! $errors->first('password','<br><small id="appHelp" class="alert alert-danger">:message</small>')!!} -->
                </div>
                <button type="submit" class="btn btn-outline-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>    
@include('layouts.final')