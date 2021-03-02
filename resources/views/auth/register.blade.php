<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>fracciones</title>
        <link href="{{ asset('csslogin/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('csslogin/css/estilos.css')}}" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        {{-- <script src="{{ asset('admin/js/all.min.js')}}" crossorigin="anonymous"></script> --}}
    </head>
    <body>
        <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
            <div class="card card0 border-0">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card1 pb-5">
                            <div class="row">
                                 <img src="{{asset('csslogin/imgenes/logoimage.png')}}" class="logo">
                            </div>
                            <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                                <img src="{{asset('csslogin/imgenes/escuelaimagen.jpg')}}" class="image">
                             </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card2 card border-0 px-4 py-5">
                                <div class="row mb-4 px-3">
                                    <h6 class="mb-0 mr-4 mt-2">Redes Sosiales</h6>
                                    <div class="facebook text-center mr-3">
                                        <div class="fa fa-facebook"></div>
                                    </div>
                                    <div class="twitter text-center mr-3">
                                        <div class="fa fa-twitter"></div>
                                    </div>
                                    <div class="linkedin text-center mr-3">
                                        <div class="fa fa-linkedin"></div>
                                    </div>
                                </div>
                            <div class="row px-3 mb-4">
                                <div class="line"></div> <small class="or text-center">Inicio</small>
                                <div class="line"></div>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row px-3">
                                    {{--  --}}
                                    <label class="small mb-1" for="nombre">Nombre </label>
                                    <input class="form-control py-4" id="nombre" name="nombre" type="text" placeholder="ejem. JOSE MANUEL" required/>
                                    <br>
                                    {!! $errors->first('nombre','<small class="alert alert-danger">:message</small>') !!}
                                </div>
                                <div class="row px-3">
                                    <label class="small mb-1" for="app">Apellido Paterno</label>
                                    <input class="form-control py-4" id="app" name="app" type="text" placeholder="ejem. SANCHEZ" required/>
                                    <br>
                                    {!! $errors->first('app','<small class="alert alert-danger">:message</small>') !!}
                                </div>
                                <div class="row px-3">
                                    <label class="small mb-1" for="apm">Apellido Materno</label>
                                    <input class="form-control py-4" id="apm" name="apm" type="text" placeholder="ejem. SANCHEZ" required/>
                                    <br>
                                    {!! $errors->first('apm','<small class="alert alert-danger">:message</small>') !!}
                                </div>
                                <div class="row px-3">
                                    <label class="small mb-1" for="direccion">Direccion</label>
                                    <input class="form-control py-4" id="direccion" name="direccion" type="text" placeholder="ejem. colonia San Jose calle palo dulce cp 72520" required/>
                                    <br>
                                    {!! $errors->first('direccion','<small class="alert alert-danger">:message</small>') !!}
                                </div>
                                <div class="row px-3">
                                    <label class="small mb-1" for="nikename">Nombre de usuario</label>
                                    <input class="form-control py-4" id="nikename" name="nikename" type="text" placeholder="ejem. Sasuke" required/>
                                    <br>
                                    {!! $errors->first('nikename','<small class="alert alert-danger">:message</small>') !!}
                                </div>
                                <div class="row px-3">
                                    <label class="small mb-1" for="inputEmailAddress">Correo electronico</label>
                                    <input class="form-control py-4" id="inputEmailAddress" type="email" name="email" aria-describedby="emailHelp" placeholder="ejemplo. juansuar12@gmail.com" required/>
                                    <br>
                                    {!! $errors->first('email','<small class="alert alert-danger">:message</small>') !!}
                                </div>
                                <div class="row px-3">
                                    <label class="small mb-1" for="inputPassword">Contraseña</label>
                                    <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter contraseña" required/>
                                    <br>
                                    {!! $errors->first('password','<small class="alert alert-danger">:message</small>') !!}
                                </div>
                                <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Registro</button> </div>
                            </form>
                            {{-- <a href="{{ route('register') }}">Registara </a> --}}
                        </div>

                    </div>
                </div>
                <div class="bg-blue py-4">
                    <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2020.</small>
                        <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
