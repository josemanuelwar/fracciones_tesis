<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>FRACCIONES</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link  href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/estilos.css')}}" rel="stylesheet" >
    </head>
    <body>
        <header>
            <ul>
                <li>
                    <a href="{{route('Inicio')}}">Inicio</a>
                </li>
                <li>
                    <a href="http://">Materia</a>
                </li>
                <li>
                    <a href="http://">Acerca</a>
                </li>
                @if(Route::has('login'))
                    @auth
                        <li>
                            <a href="{{ url('/home') }}">inicio</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">Registro</a>
                        </li>      
                        @endif
                    @endauth
                @endif
            </ul>
        </header>        
        <section id="contenido">