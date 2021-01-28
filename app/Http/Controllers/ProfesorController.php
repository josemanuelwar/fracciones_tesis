<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escuela;
use App\Models\User;
use App\Models\Materia;
use App\Models\Materias_has_escuela;
use App\Models\Grado;
use Illuminate\Support\Facades\DB;
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

    public function Matreria(Request $request)
    {
        if($request->ajax()){
            return Grado::get();
        }
        return view('profesor.RegistrarMateria');
    }
    /** funcion para guardar las materias
     * @param(nombre materia) @param(abreviatura) @param(grado_id)
     */
    public function GuardarMateria(Request $request)
    {
        /** validamos que los campos son requeridos  */
        $validacion=$request->validate([
            'nombreMateria'=>'required|max:60',
            'abreviatura'=>'required|max:60',           
           ]);
    
        /** creamos objetos de los modelos y guardamos los datos  */    
        $materia=new Materia();
        $materia->nombremateria=$validacion['nombreMateria'];
        $materia->siglasmaterias = $validacion['abreviatura'];
        $materia->save();
        $materiaid=Materia::latest('id')->first();

        $escuelmatera = array('escuelas_id' => auth()->user()->escuelas_id,
                               'materias_id' => $materiaid['id']);
                               
        $res=DB::table('materias_has_escuelas')->insert($escuelmatera);
        $res1=DB::table('materias_has_grados')->insert(["materias_id"=>$materiaid['id'],
        "grados_id"=>$request->post('idgrado')]);
        if($res === true && $res1 === true){
            return response()->Json(true);
        }
        else
        {
            return response()->Json(false);
        }
            
    }
    /** mostramos todo las materias  que tiene un usuario */
    public function ListaMaterias()
    {
       $materia= new Materia();
       $lista=$materia->getMaterias(auth()->user()->escuelas_id);
       return response()->Json($lista);
    }

    public function ActulizarMateria()
    {
        echo "holas";
    }



}
