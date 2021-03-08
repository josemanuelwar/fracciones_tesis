<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Grado;
use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CacheMaterias;
use App\Repositories\CacheEscuela;
use App\Repositories\CaheUsuario;
class ProfesorController extends Controller
{
    protected $materias;
    protected $escuelas;
    protected $usuarios;
    public function __construct(CacheMaterias $materia,CacheEscuela $escuela,CaheUsuario $usuario)
    {
        $this->materias=$materia;
        $this->escuelas=$escuela;
        $this->usuarios=$usuario;
        $this->middleware(['auth','roles']);
    }

    public function index()
    {
        $resultado=$this->escuelas->getEscuela();
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
        $url=$request->file('imagen')->store('public/escuela');
        $this->escuelas->guardar($validacion,$url);
        return back()->with('success','Se ha guardado correctamente');
    }

    /**asignamos la escuela */
    public function AsignacionEscuela($id)
    {
      $this->usuarios->AsignacioEscuela(auth()->user()->id, $id);
        return json_encode(true);
    }
    //retornamos  la escuela
    public function getEscuela($id)
    {
        return $this->escuelas->getEscuelas($id);
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
        if( $request->hasFile('imageneditar')){
            Storage::delete($actualizar->rutaimagen);
           $url=$request->file('imageneditar')->store('public/escuela');
           $this->escuelas->actulizar($validacion,$url);
       }else{
           $this->escuelas->actulizarimagen($validacion);
       }

       return back()->with('success','Se ha actualizado correctamente');
    }

    public function EliminarEscuela(Request $request)
    {
        $validacion=$request->validate([
            'escuelaid'=>'required|max:11'
        ]);
        $this->escuelas->eliminar($validacion);
        return back()->with('success','Se ha eliminado correctamente');
    }

    public function Matreria(Request $request)
    {
        $resultaad=Grado::get();
        $lista=$this->materias->getMaterias(auth()->user()->escuelas_id);
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
        $url=$request->file('imagen')->store('public/Materia');
        //llamamos las funcion de los repsitorios
        $materiaid=$this->materias->guardar($validacion,$url);
        $escuelmatera = array('escuelas_id' => auth()->user()->escuelas_id,
                               'materias_id' => $materiaid['id']);
        $gradomateria = array("materias_id"=>$materiaid['id'],
        "grados_id"=>$request->post('listagardos'));
        //funcion del reposcitorio
        $res=$this->materias->materias_has_escuelas($escuelmatera);
        $res1=$this->materias->materias_has_grados($gradomateria);
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
        $this->materia->Eliminar($validation);
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
        $resultado= $this->materias->Actualizar($validation['idmateria'],$data,$validation['listagardoseditar'],$validation['idateriorgra']);
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