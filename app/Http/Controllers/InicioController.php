<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Tema;
use App\Models\Pregunta;
class InicioController extends Controller
{
    public function index()
    {
        $materias = new Materia();
        $resul=$materias->materiagrado();
        return view('welcome')->with("materias",$resul);
    }

    public function Temarios($id)
    {
        $rest=Tema::where('materias_id',$id)->get();
        return view('alumnos.Temario')->with('temario',$rest);
    }

    public function preguntas($id)
    {
        return view('alumnos.preguntas')->with('idtemario',$id);
    }
}
