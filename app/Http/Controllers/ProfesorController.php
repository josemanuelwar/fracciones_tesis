<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escuela;
use App\Models\User;
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
       $usuarios = new User();

       $actulizar=$usuarios->find(auth()->user()->id);
       $actulizar->escuelas_id=$id;
       $actulizar->save();
        return json_encode(true);
    }

    public function getEscuela($id)
    {
        return Escuela::find($id);
    }

    public function UpdateEscuela(Request $request)
    {
       $validacion=$request->validate([
        'idEscuela'=>'required|max:11',
        'nombreescuela'=>'required|max:100',
        'direccion'=>'required|max:120'           
       ]);
       $escuela=new Escuela();
       $actualizar=$escuela->find($request->post('idEscuela'));
       $actualizar->nombre_escuela=$request->post('nombreescuela');
       $actualizar->direccion=$request->post('direccion');
       $actualizar->save();
       return json_encode(true);
    }

}
