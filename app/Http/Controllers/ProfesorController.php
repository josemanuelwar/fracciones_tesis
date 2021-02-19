<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Escuela;
use App\Models\User;
use App\Models\Materia;
use App\Models\Materias_has_escuela;
use App\Models\Grado;
use App\Models\Pregunta;
use App\Models\Respuesta;
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
    /** registramos la escuela */
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
    /**asignamos la escuela */
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
    /** actualizamos el registro de la escuela */
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
    /**
     * actualizamos la materias
     * @param(idmateria,nombre,siglas,idgrado,idanterir)
     * esto son los parametros
     */
    public function ActulizarMateria(Request $request)
    {
        $validation=$request->validate([
            'idmateria'=>'required|max:11',
            'nombremateria'=>'required|max:100',
            'abreviatura'=>'required|max:60',
            'idgrado'=>'required|max:11',
            'idgradoanterior'=>'required|max:11'           
           ]);
        $data = array('nombremateria' => $validation['nombremateria'],
                      'siglasmaterias'=>$validation['abreviatura']);
        $updateMat = new Materia();
        $resultado= $updateMat->actualizarMateria($validation['idmateria'],$data,$validation['idgrado'],$validation['idgradoanterior']);    
        
        return response()->Json($resultado);
    }

    public function Respuesta($id)
    {
        $res=Pregunta::where('id',$id)->get();        
        return view("profesor.agregarRespuesta")->with('pregunta',$res);
    }

    public function GuardarRespuestas(Request $request)
    {
        $res=false;
        $validation=$request->validate(['respuestas' => 'required',
                                        'incisos' => 'required',
                                        'idpregunta'=>'required']);
        $respuesta=$validation['respuestas'];
        $correcta= $validation['incisos'];
        if($respuesta != null && $correcta != null){
            $i=0;
            foreach($respuesta as $res){
                $res=Respuesta::create([ 'respuesta'=>$res,
                                    'corecta'=>$correcta[$i],
                                    'preguntas_id'=>$validation['idpregunta']]);
                $i++;                    
            }
        }
        return response()->Json(true);
    }

    public function vistaprevia($id)
    {
        $res=Pregunta::where('id',$id)->get(); 
        $resp=Respuesta::where('preguntas_id',$id)->get();
        $inciso=['A','B','C','D'];  
        return view('profesor.Vistaprevia')->with('vista',$res)->with('respuesta',$resp)->with('inciso',$inciso);
    }

    public function Editarpregunta($id)
    {
        $res=Pregunta::where('id',$id)->get(); 
        $resp=Respuesta::where('preguntas_id',$id)->get();
        return view('profesor.EditarPregun')->with('pregunta',$res)
                ->with('respuestas',$resp);
    }

    public function ActualizarPreguntas(Request $request)
    {
        $validation=$request->validate(['respuest'=>'required|array',
                    'preguntas'=>'required|array',
                    'respuestacorecta'=>'required|array']);
        $preguntas=$validation['preguntas'];
        $respuesta=$validation['respuest'];
        $corecta=$validation['respuestacorecta'];
        /**preguntas */
        $preg = new Pregunta();
            $update=$preg->find($preguntas['idpregunta']);
            $update->reactivo=$preguntas['pregunsta'];
            $update->nivel=$preguntas['nivel'];
            $update->save();
        $res = new Respuesta();
            $update=$res->find($respuesta['idrespuestaA']);
            $update->respuesta=$respuesta['respuestaA'];
            $update->corecta=$corecta[0];
            $update->preguntas_id=$preguntas['idpregunta'];
            $update->save();
            
            $update=$res->find($respuesta['idrespuestaB']);
            $update->respuesta=$respuesta['respuestaB'];
            $update->corecta=$corecta[1];
            $update->preguntas_id=$preguntas['idpregunta'];
            $update->save();

            $update=$res->find($respuesta['idrespuestaC']);
            $update->respuesta=$respuesta['respuestaC'];
            $update->corecta=$corecta[2];
            $update->preguntas_id=$preguntas['idpregunta'];
            $update->save();

            $update=$res->find($respuesta['idrespuestaD']);
            $update->respuesta=$respuesta['respuestaD'];
            $update->corecta=$corecta[3];
            $update->preguntas_id=$preguntas['idpregunta'];
            $update->save();       
        return response()->Json(true);        
    }
}