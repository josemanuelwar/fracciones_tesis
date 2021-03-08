<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tema;
use App\Models\Pregunta;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\CacheEscuela;
use App\Repositories\CacheMaterias;
use App\Repositories\CahePersonas;
use App\Repositories\CaheUsuario;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $escuela;
    protected $materia;
    protected $persona;
    protected $usuario;
    public function __construct(CacheEscuela $escuelas, CacheMaterias $materias, CahePersonas $pesonas, CaheUsuario $usuarios)
    {
        $this->escuela=$escuelas;
        $this->materia=$materias;
        $this->persona=$pesonas;
        $this->usuario=$usuarios;
        $this->middleware(['auth','roles']);
       
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    /**
     * metodo mostrar la vista de registro de alumnos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function registroAlumnos(){
        $todas=$this->escuela->getEscuela();
        return view('profesor.regiAlumnos')->with("escuela",$todas);
    }
    /**
     * metodo de registrar los alumnos del profesor.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function GusrdarAlumno(Request $request)
    {
        $validacion=$request->validate([
            'nombre' => 'required|max:60',
            'app' => 'required|max:60',
            'apm' => 'required|max:60',
            'direccion' => 'required|max:120',
            'escuela' => 'required|max:60',
            'email' => 'required|max:60|email|unique:users',
            'password' => 'required|max:60|min:8',
        ]);
            /** traemos el ultimo id que se genero en la insercion en la tabla personas */
            $idpersona=$this->persona->Guardarpersonas($validacion);
            $this->usuario->gauradarUsuario($validacion,$idpersona);
            return back()->with('success','Se ha registrado correctamente');
    }
    /** inicio de los temarios*/
    public function Agregartemarios()
    {
        $res=$this->materia->getMaterias(auth()->user()->escuelas_id);
        $temas=new Tema();
        $listatemas=$temas->getTemas(auth()->user()->escuelas_id);
        return view('profesor.agregartemario')->with('materias',$res)->with('temas',$listatemas);

    }

    /** guarda mos los datos en la base de dats */
    public function guardarTemas(Request $request)
    {
        $validacion=$request->validate([
            'tema' => 'required|max:60',
            'materia' => 'required|max:11',
            'numero' => 'required|max:11',
            'video'=>'required|mimetypes:video/avi,video/mpeg,video/mp4'
        ]);
        $temas=new Tema();
        $temas->nombre_tema=$validacion['tema'];
        $temas->numerodepreguntas=$validacion['numero'];
        $temas->materias_id=$validacion['materia'];
        $temas->rutavideo=$request->file('video')->store('public/videos');
        $temas->eliminartemas=1;
        $temas->save();
        return back()->with('success','Se ha registrado correctamente');
    }
   /** cargamos la vista  */
    public function preguntas(Request $request ,$id=null)
    {
        $resu=Tema::where('id',$id)->get(); 
        $preguntas=Pregunta::get();         
        return view('profesor.agregarpreguntas')
                ->with('temas',$resu)
                ->with('preguntas',$preguntas);
    }
    /** solo cargar la vista del formulario para el exel */
    public function FormulariocargarExel()
    {
        return view('profesor.cargarExel');
    }

    /**
     * importamos los datos de exel a la base de datos 
     */
    public function ImportarExel(Request $request)
    {
        $file=$request->file('excel');
        Excel::import(new UsersImport, $file);
        return back()->with('message','Importancion de usuarios completa');
    }
    //cargamos la vista del los alumnos
    public function ListaUsuarios(Request $request)
    {
        if($request->ajax()) 
        {
            $alumnos=$this->persona->paginacionAlumnos(auth()->user()->id);
            return $alumnos;         
        }else{
            $alumnos=$alumnos=$this->persona->paginacionAlumnos(auth()->user()->id);
        }
        return view('profesor.Listausuarios')->with('alumnos',$alumnos);
    }
    //cargamos el formulario editar de usuarios
    public function editarview(Request $request, $id)
    {
        $alumnos=$this->persona->getpersonas($id);
        $todas=$this->escuela->getEscuela();
        return view('profesor.Editarusuarios')->with('alumnos',$alumnos)->with('id',$id)
        ->with('escuelas',$todas);
    }

    public function editarAlumnos(Request $request)
    {
        # code...
        $validacion=$request->validate([
            'nombre' => 'required|max:60',
            'app' => 'required|max:60',
            'apm' => 'required|max:60',
            'direccion' => 'required|max:120',
            'escuela' => 'required|max:60',
            'email' => 'required|max:60|email',
            'id'=>'required|max:11'
            ]);
        $datos=array('nombrecompleto'=>$request->post('nombre'),
                    'apellido_paterno'=>$request->post('app'),
                    'apellido_materno'=>$request->post('apm'),
                    'direccion'=>$request->post('direccion'),);
        if($request->post('password1') != null)
        {            
            $data = array(
            'nombre_usuario' =>$request->post('nombre'),  
            'email'=>$request->post('email'),
            'password'=>$request->post('password1'),
            'escuelas_id'=>$request->post('escuela'));
        }
        else
        {
            $data = array(
                'nombre_usuario' => $request->post('nombre'),
                'email'=>$request->post('email'),
                'escuelas_id'=>$request->post('escuela')
            );
        }    

        $id=$request->post('id');
        $update=$this->persona->actualizarpersonas($datos,$id,$data); 
        if($update){
            return back()->with('success','Datos Actulizados correctamente');
        }else{
            return back()->with('message','Error en Actulizar los datos');
        }                  
    }
    
    /**
     * Editamos los temas si se equivocal en la siganacion
     */
    public function EditarTema(Request $request)
    {
        
            $validacion=$request->validate([
                'idtema'=>'required|max:60',
                'temaeditar'=>'required|max:60',
                'materiaeditar'=>'required|max:60',
                'numeroeditar'=>'required|max:60'
            ]);
            if($request->hasFile('videoeditar'))
            {
                // Storage::delete($archivo->rutavideo);
                $data = array('nombre_tema' =>$validacion['temaeditar'] ,
                        'numerodepreguntas'=>$validacion['materiaeditar'],
                    'materias_id'=>$validacion['numeroeditar'],
                'rutavideo'=>$request->file('videoeditar')->store('public/videos'));
            }else{
                $data = array('nombre_tema' =>$validacion['temaeditar'] ,
                        'numerodepreguntas'=>$validacion['materiaeditar'],
                    'materias_id'=>$validacion['numeroeditar']);
            }
            $resu=Tema::where('id',$validacion['idtema'])->update($data);
            if($resu){
                return back()->with('success','Se ha gauradado correctamente');
            }else{
                return back()->with('danger','Se ha gauradado correctamente');
            }
                
    }
    /** guardamo las preguntas de los temas */
    public function GuardarPreguntas(Request $request)
    {
        $validatio=$request->validate([
         'idTema' => 'required|max:60',
         'preguntas' => 'required|min:10',
         'nivel' => 'required|max:10 |min:4',
         'numero' => 'required'
        ]);
        $pregunta= new Pregunta();
        $pregunta->reactivo = $validatio['preguntas'];
        $pregunta->nivel = $validatio['nivel'];
        $pregunta->temas_id = $validatio['idTema'];
        $pregunta->save();
        
        $numeropregunta=$validatio['numero'];
        $total=$numeropregunta-1;

        $tema = new Tema();
        $id=$validatio['idTema'];
        $tema->updateTema($id,$total);
        
        return back()->with('message','Se ha gauradado correctamente');    
    }    
}
