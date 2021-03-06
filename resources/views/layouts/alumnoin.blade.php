<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>FRACCIONES</title>
        <!-- Fonts -->
        <link  href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('bootstrap/css/estilos.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('bootstrap/js/jqueryui/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        {{-- <link href="{{asset('css/estilos.css')}}" rel="stylesheet" > --}}
    </head>
    <body>
        {{-- menu del alumno empezamso con el menu --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">FRACCIONES</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>

              @if(auth()->guest())
                <a href="{{ route('login') }}" class="btn btn-danger">Login</a>
              @else
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <a class="btn btn-primary dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{auth ()->user()->nombre_usuario }}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    {{-- <a class="dropdown-item" href="#">Action</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    {{ __('Cerrar Seccion') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                    {{-- <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a> --}}
                  </div>
                </li>
              </ul>
              @endif
            </div>
          </nav>

          <div class="d-flex flex-column h-screen justify-content-between">


















