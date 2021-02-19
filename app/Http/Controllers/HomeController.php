<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;
use App\Models\Escuela;
use App\Models\Materia;
use App\Models\Tema;
use App\Models\Pregunta;

use App\Models\grado_primaria;
use Illuminate\Support\Facades\Hash;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $escuela=new Escuela();
        $todas=$escuela->get();
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
            // 'Escuela' => 'required|max:60',
            'email' => 'required|max:60|email|unique:users',
            'password' => 'required|max:60|min:8',
            ]);
            /*** gaurdamos en la tabla personas */
            $persona=new Persona();
            $persona->nombrecompleto=$request->post('nombre');
            $persona->apellido_paterno=$request->post('app');
            $persona->apellido_materno=$request->post('apm');
            $persona->direccion=$request->post('direccion');
            $persona->save();
            /** traemos el ultimo id que se genero en la insercion en la tabla personas */
            $idpersona = Persona::latest('id')->first();
            /**guardamos en la tabla usuarios */
            $usuarios = new User();
            $usuarios->nombre_usuario = $request->post('nombre');
            $usuarios->email = $request->post('email');
            $usuarios->password = Hash::make($request->post('password'));
            $usuarios->roles_id = 3;
            $usuarios->personas_id = $idpersona['id'];
            $usuarios->users_id = auth()->user()->id;
            $usuarios->escuelas_id=auth()->user()->escuelas_id;
            $usuarios->save();
            // $request->session()->flash('status', 'Task was successful!');
            return back()->with('success','Se ha registrado correctamente');
    }

    public function Agregartemarios()
    {
        // dd($nivel);
        return view('profesor.agregartemario');

    }
    /** mandamos la lista de grado que estan en la base de datos */
    public function ListaGardosVue()
    {
        $lista=new Materia();
        $res=$lista->getMaterias(auth()->user()->escuelas_id);
        return $res;
        
    }
    /** mandamos los datos a la vista */
    public function verListatemas()
    {

        $temas=new Tema();
        $listatemas=$temas->getTemas(auth()->user()->escuelas_id);
        return json_encode($listatemas);
    }
    /** guarda mos los datos en la base de dats */
    public function guardarTemas(Request $request)
    {
        $validacion=$request->validate([
            'tema' => 'required|max:60',
            'idgrado' => 'required|max:11',
            'pregnum' => 'required|max:11'
        ]);

        $temas=new Tema();
        $temas->nombre_tema=$validacion['tema'];
        $temas->numerodepreguntas=$validacion['pregnum'];
        $temas->materias_id=$validacion['idgrado'];
        $temas->save();

        return json_encode(true);
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
            $personas=new Persona();
            $alumnos=$personas->ListaAlumnos(auth()->user()->id);
            return $alumnos;         
        }
        return view('profesor.Listausuarios');
    }
    //cargamos el formulario editar de usuarios
    public function editarview(Request $request, $id)
    {
        $persona=new Persona();
        $alumnos=$persona->Alumnos($id);
        $escuela=new Escuela();
        $todas=$escuela->get();
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
        $persona=new Persona(); 
        $update=$persona->actualizarAlumno($datos,$id,$data); 
        if($update){
            return back()->with('success','Datos Actulizados correctamente');
        }else{
            return back()->with('message','Error en Actulizar los datos');
        }                  
        // dd($datos);
    }
    
    /**
     * Editamos los temas si se equivocal en la siganacion
     */
    public function EditarTema(Request $request)
    {
        if($request->ajax()) 
        {
            $validacion=$request->validate([
                'idtema'=>'required|max:60',
                'tema'=>'required|max:60',
                'idgardo'=>'required|max:60',
                'numpreg'=>'required|max:60'
            ]);
            $data = array('nombre_tema' =>$validacion['tema'] ,
                        'numerodepreguntas'=>$validacion['numpreg'],
                    'materias_id'=>$validacion['idgardo']);
             $resu=Tema::where('id',$validacion['idtema'])->update($data);
            return json_encode($resu);
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
