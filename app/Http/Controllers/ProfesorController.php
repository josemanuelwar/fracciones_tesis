<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Escuela;
use App\Models\User;
use App\Models\Materia;
use App\Models\Grado;
use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class ProfesorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles']);
    }

    public function index()
    {
        $resultado=Escuela::where('Eliminar',1)->get();
        return view('profesor.registrarescuela')->with('Escuelas',$resultado);
    }
    /** registramos la escuela */
    public function GaudarEscuela(Request $request)
    {
        $validacion=$request->validate([
            'escuela'=>'required|max:100',
            'direccion'=>'required|max:120',
            'imagen'=>'required|image'
        ]);
        
        $escuela=new Escuela();
        $escuela->nombre_escuela=$validacion['escuela'];
        $escuela->direccion=$validacion['direccion'];
        $escuela->rutaimagen=$request->file('imagen')->store('public/escuela');
        $escuela->Eliminar=1;
        $escuela->save();
        return back()->with('success','Se ha guardado correctamente');
        
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
    //retornamos  la escuela 
    public function getEscuela($id)
    {
        return Escuela::find($id);
    }

    /** actualizamos el registro de la escuela */
    public function UpdateEscuela(Request $request)
    {
       $validacion=$request->validate([
        'idEscuela'=>'required|max:11',
        'escuelaeditar'=>'required|max:100',
        'direccionediatra'=>'required|max:120',
        'imageneditar'=>'image'           
       ]);
       $escuela=new Escuela();
       $actualizar=$escuela->find($validacion['idEscuela']);
       $actualizar->nombre_escuela=$validacion['escuelaeditar'];
       $actualizar->direccion=$validacion['direccionediatra'];
       if( $request->hasFile('imageneditar')){
            Storage::delete($actualizar->rutaimagen);
           $actualizar->rutaimagen=$request->file('imageneditar')->store('public/escuela');
       }
       $actualizar->save();
       return back()->with('success','Se ha actualizado correctamente');
    }

    public function EliminarEscuela(Request $request)
    {
        $validacion=$request->validate([
            'escuelaid'=>'required|max:11'         
        ]);
        $escuela=new Escuela();
        $actualizar=$escuela->find($validacion['escuelaid']);
        // dd($actualizar);
        $actualizar->Eliminar=0;
        $actualizar->save();
        return back()->with('success','Se ha eliminado correctamente');
    }

    public function Matreria(Request $request)
    {
        $resultaad=Grado::get();
        $materia= new Materia();
        $lista=$materia->getMaterias(auth()->user()->escuelas_id);
       
        return view('profesor.RegistrarMateria')->with('grados',$resultaad)
        ->with('lista',$lista);
    }
    /** funcion para guardar las materias
     * @param(nombre materia) @param(abreviatura) @param(grado_id)
     */
    public function GuardarMateria(Request $request)
    {
        /** validamos que los campos son requeridos  */
        $validacion=$request->validate([
            'materia'=>'required|max:60',
            'abrebiatura'=>'required|max:60', 
            'listagardos'  =>  'required|max:60',
            'imagen'=>'required|image'
           ]);
    
        /** creamos objetos de los modelos y guardamos los datos  */    
        $materia=new Materia();
        $materia->nombremateria=$validacion['materia'];
        $materia->siglasmaterias = $validacion['abrebiatura'];
        $materia->urlimagenmat=$request->file('imagen')->store('public/Materia');
        $materia->Eliminarmat=1;
        $materia->save();
        $materiaid=Materia::latest('id')->first();

        $escuelmatera = array('escuelas_id' => auth()->user()->escuelas_id,
                               'materias_id' => $materiaid['id']);
                               
        $res=DB::table('materias_has_escuelas')->insert($escuelmatera);
        $res1=DB::table('materias_has_grados')->insert(["materias_id"=>$materiaid['id'],
        "grados_id"=>$request->post('listagardos')]);
        if($res === true && $res1 === true){
            return back()->with('success','Se ha guardado correctamente');
        }
        else
        {
            return back()->with('danger','No se ha guardado correctamente');
        }
            
    }
    /** mostramos todo las materias  que tiene un usuario */
    public function eliminarMaterias(Request $request)
    {
        $validation=$request->validate([
            'materiaid'=>'required|max:11',
        ]);
        $mat=new Materia();
        $elim=$mat->find($validation['materiaid']);
        $elim->Eliminarmat=0;
        $elim->save();
        return back()->with('success','Se ha eliminado correctamente');
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
            'materiaeditar'=>'required|max:100',
            'abrebiaturaeditar'=>'required|max:60',
            'listagardoseditar'=>'required|max:11',
            'idateriorgra'=>'required|max:11',
            'imageneditar'=>'image',                 
           ]);
        
        if($request->hasFile('imageneditar')){
            $mat=new Materia();
            $elim=$mat->find($validation['idmateria']);
            Storage::delete($elim->urlimagenmat);
            $data = array('nombremateria' => $validation['materiaeditar'],
                      'siglasmaterias'=>$validation['abrebiaturaeditar'],
                      'urlimagenmat'=>$request->file('imageneditar')->store('public/Materia')
                    );
        }else{
            $data = array('nombremateria' => $validation['materiaeditar'],
                      'siglasmaterias'=>$validation['abrebiaturaeditar'],
                );
        }   
        
        $updateMat = new Materia();
        $resultado= $updateMat->actualizarMateria($validation['idmateria'],$data,$validation['listagardoseditar'],$validation['idateriorgra']);    
        
        if($resultado){
            
            return back()->with('success','Se ha actualizado correctamente');
        }
        else
        {
            return back()->with('danger','No se ha actualizado correctamente');
        }
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