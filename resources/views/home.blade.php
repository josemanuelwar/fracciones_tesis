@include('layouts.Inicio')
<div class="container-fluid">
    <h1 class="mt-4" style="text-align: center;"> ! Biemvenido !</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Menu</li>
    </ol>
    <div class="row">    
        <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">IMPORTA ALUMNOS</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('Cargr-exel')}}">IMPORTAR</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
        </div>
        <div class="col-xl-4 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">REGISTAR ALUMNOS</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('Alumnos')}}">REGISTRAR</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
        </div>
        <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">LISTA ALUMNOS</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('ListaAlum')}}">LISTA</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
        </div>
        <div class="col-xl-4 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">REGISTRO DE ESCUELA</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('Escuela')}}">ESCUELA</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
        </div>
        <div class="col-xl-4 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">REGISTRAR MATERIA</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('Materia')}}">MATERIA</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
        </div>
        <div class="col-xl-4 col-md-6">
                <div class="card  text-white mb-4" style="background-color:#FFD5B3">
                    <div class="card-body">AGREGAR TEMA</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('temas')}}">TEMA</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
        </div>
    
        <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">CALIFICACIONES ALUMNOS</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="">CALIFICASIONES</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
        </div>

    </div>
</div>
@include('layouts.final')
