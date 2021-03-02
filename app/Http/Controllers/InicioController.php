<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Tema;
use App\Models\Pregunta;
use App\Models\Respuesta;
class InicioController extends Controller
{
    public function __construct()
    {
        
        $this->middleware(['auth','roles']);
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

    public function preguntasajax($id)
    {
        $resutado=Pregunta::where('temas_id',$id)->get();
        return $resutado;
    }

    public function respuestas($id)
    {
        $resutado=Respuesta::where('preguntas_id',$id)->get();
        return $resutado;
    }
}
