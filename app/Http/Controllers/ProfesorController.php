<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escuela;

class ProfesorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles']);
    }

    public function index()
    {
        return view('profesor.registrarescuela');
    }

    public function GaudarEscuela(Request $request)
    {
        $validacion=$request->validate([
            'nombreescuela'=>'required|max:100',
            'direccion'=>'required|max:120'
        ]);
        $escuela=new Escuela();
        $escuela->nombre_escuela=$request->post('nombreescuela');
        $escuela->direccion=$request->post('direccion');
        $res=$escuela->save();
        return json_encode('true');
    }

    public function ListaEscuela()
    {
       return Escuela::get();
    }

    public function AsignacionEscuela($id)
    {
       echo "hola";
    }

}
