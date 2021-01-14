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
                    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp" placeholder="Ingresa el nombre" value="{{$alumnos[0]->Nombre}}"/>   
                    {!! $errors->first('nombre','<br><small id="nombreHelp6" class="alert alert-danger">:message</small>') !!}
                </div>
                <div class="form-group">
                    <label for="app">Apellido Paterno</label>
                    <input type="text" class="form-control" id="app" name="app" aria-describedby="appHelp" placeholder="Ingresa el nombre" value="{{$alumnos[0]->App}}" />
                    {!! $errors->first('app','<br><small id="appHelp5" class="alert alert-danger">:message</small>')!!}
                </div>
                <div class="form-group">
                    <label for="apm">Apellido Materno</label>
                    <input type="text" class="form-control" id="apm" name="apm" aria-describedby="apmHelp" placeholder="Ingresa el nombre" value="{{$alumnos[0]->Apm}}" />
                    {!! $errors->first('apm','<br><small id="appHelp4" class="alert alert-danger">:message</small>')!!}
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="direccionHelp" placeholder="Ingresa el nombre" value="{{$alumnos[0]->Direccion}}"/>
                    {!! $errors->first('direccion','<br><small id="appHelp3" class="alert alert-danger">:message</small>')!!}
                </div>
                <div class="form-group">
                    <label for="Escuela">Escuela</label>
                    <input type="text" class="form-control" id="Escuela" name="Escuela" aria-describedby="EscuelaHelp" placeholder="Ingresa el nombre" value="{{$alumnos[0]->Escuela}}"/>
                    {!! $errors->first('Escuela','<br><small id="appHelp2" class="alert alert-danger">:message</small>')!!}
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Correo Electronico</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{$alumnos[0]->email}}"/>
                    {!! $errors->first('email','<br><small id="appHelp1" class="alert alert-danger">:message</small>')!!}
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password1" placeholder="Password" >
                    <!-- {!! $errors->first('password','<br><small id="appHelp" class="alert alert-danger">:message</small>')!!} -->
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>    
@include('layouts.final')