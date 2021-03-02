<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Tema;
use App\Models\Pregunta;
use App\Models\Respuesta;


class AlumnoController extends Controller
{
	public function __construct()
    {

        $this->middleware(['auth','roles']);
    }

    public function index()
    {

        $materias = new Materia();
        // dd($materias);
        $resul=$materias->materiagrado();
        return view('welcome')->with("materias",$resul);
    }


}
