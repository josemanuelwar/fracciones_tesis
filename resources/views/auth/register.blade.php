<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Fracciones</title>
        <link href="{{ asset('admin/css/styles.css')}}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Crear Cuenta</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="nombre">Nombre </label>
                                                        <input class="form-control py-4" id="nombre" name="nombre" type="text" placeholder="ejem. JOSE MANUEL" required/>
                                                        <br>
                                                        {!! $errors->first('nombre','<small class="alert alert-danger">:message</small>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="app">Apellido Paterno</label>
                                                        <input class="form-control py-4" id="app" name="app" type="text" placeholder="ejem. SANCHEZ" required/>
                                                        <br>
                                                        {!! $errors->first('app','<small class="alert alert-danger">:message</small>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="apm">Apellido Materno</label>
                                                        <input class="form-control py-4" id="apm" name="apm" type="text" placeholder="ejem. SANCHEZ" required/>
                                                        <br>
                                                        {!! $errors->first('apm','<small class="alert alert-danger">:message</small>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="direccion">Direccion</label>
                                                        <input class="form-control py-4" id="direccion" name="direccion" type="text" placeholder="ejem. colonia San Jose calle palo dulce cp 72520" required/>
                                                        <br>
                                                        {!! $errors->first('direccion','<small class="alert alert-danger">:message</small>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="escuela">Escuela</label>
                                                        <input class="form-control py-4" id="escuela" name="escuela" type="text" placeholder="ejem. OCTAVIO PAZ" required/>
                                                        <br>
                                                        {!! $errors->first('escuela','<small class="alert alert-danger">:message</small>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="nikename">Nombre de usuario</label>
                                                        <input class="form-control py-4" id="nikename" name="nikename" type="text" placeholder="ejem. Sasuke" required/>
                                                        <br>
                                                        {!! $errors->first('nikename','<small class="alert alert-danger">:message</small>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Correo electronico</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" name="email" aria-describedby="emailHelp" placeholder="ejemplo. juansuar12@gmail.com" required/>
                                                <br>
                                                        {!! $errors->first('email','<small class="alert alert-danger">:message</small>') !!}
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Contraseña</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter contraseña" required/>
                                                <br>
                                                        {!! $errors->first('password','<small class="alert alert-danger">:message</small>') !!}
                                            </div>
                                                
                                            <div class="form-group mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary btn-block" value="Crear cuenta"/>
                                                <!-- <a class="btn btn-primary btn-block" href="login.html">Create Account</a> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('admin/js/scripts.js')}}"></script>
    </body>
</html>
