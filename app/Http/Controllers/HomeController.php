<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\personas;
use App\Models\grado_primaria;
use App\Models\temas;
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
        return view('profesor.regiAlumnos');
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
            'Escuela' => 'required|max:60',
            'email' => 'required|max:60|email|unique:users',
            'password' => 'required|max:60|min:8',
            ]);
            /*** gaurdamos en la tabla personas */
            $persona=new personas();
            $persona->Nombre=$request->post('nombre');
            $persona->App=$request->post('app');
            $persona->Apm=$request->post('apm');
            $persona->Direccion=$request->post('direccion');
            $persona->Escuela=$request->post('Escuela');
            $persona->save();
            /** traemos el ultimo id que se genero en la insercion en la tabla personas */
            $idpersona = personas::latest('id')->first();
            /**guardamos en la tabla usuarios */
            $usuarios = new User();
            $usuarios->nombre_usuario = $request->post('nombre');
            $usuarios->email = $request->post('email');
            $usuarios->password = Hash::make($request->post('password'));
            $usuarios->rol = 3;
            $usuarios->persona = $idpersona['id'];
            $usuarios->maestro = auth()->user()->id;
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
        return grado_primaria::all();
        
    }
    /** mandamos los datos a la vista */
    public function verListatemas()
    {

        return grado_primaria::with('temas')->get();
    }
    /** guarda mos los datos en la base de dats */
    public function guardarTemas(Request $request)
    {
        $validacion=$request->validate([
            'tema' => 'required|max:60',
            'idgrado' => 'required|max:60',
        ]);

        $temas=new temas();
        $temas->nombre_tema=$request->post('tema');
        $temas->usuario_id=auth()->user()->id;
        $temas->grado_primaria_id=$request->post('idgrado');
        $temas->save();

        return json_encode(true);
    }
   /** cargamos la vista  */
    public function preguntas()
    {
        return view('profesor.agregarpreguntas');
    }

    public function ListaTemas($id)
    {
        $temas=temas::where('grado_primaria_id',$id)->get();
            return json_encode($temas);    
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
            $persona=new personas();
            $id=auth()->user()->id;
            $alumnos=$persona->listaAlumnos($id);
            return $alumnos;
        }
        return view('profesor.Listausuarios');
    }
    //cargamos el formulario editar de usuarios
    public function editarview(Request $request, $id)
    {
        $persona=new personas();
        $alumnos=$persona->Alumno($id);
        return view('profesor.Editarusuarios')->with('alumnos',$alumnos)->with('id',$id);
    }

    public function editarAlumnos(Request $request)
    {
        # code...
        $validacion=$request->validate([
            'nombre' => 'required|max:60',
            'app' => 'required|max:60',
            'apm' => 'required|max:60',
            'direccion' => 'required|max:120',
            'Escuela' => 'required|max:60',
            'email' => 'required|max:60|email',
            'id'=>'required|max:11'
            ]);
        $datos=array('Nombre'=>$request->post('nombre'),
                    'App'=>$request->post('app'),
                    'Apm'=>$request->post('apm'),
                    'Direccion'=>$request->post('direccion'),
                    'Escuela'=>$request->post('Escuela'));
        if($request->post('password1') != null)
        {            
            $data = array(
            'nombre_usuario' =>$request->post('nombre'),  
            'email'=>$request->post('email'),
            'password'=>$request->post('password1'));
        }
        else
        {
            $data = array(
                'nombre_usuario' => $request->post('nombre'),
                'email'=>$request->post('email'));
        }    

        $id=$request->post('id');
        $persona=new personas(); 
        $update=$persona->UpdateAlumnos($datos,$id,$data); 
        if($update){
            return back()->with('success','Datos Actulizados correctamente');
        }else{
            return back()->with('message','Error en Actulizar los datos');
        }                  
        // dd($datos);
    }
    
    public function EliminarUsuario(Request $request)
    {
        
    }

    public function EditarTema(Request $request)
    {
        if($request->ajax()) 
        {
            $validacion=$request->validate([
                'idtema'=>'required|max:60',
                'tema'=>'required|max:60',
                'idgardo'=>'required|max:60'
            ]);
            $id=$request->post('idtema');
            $data = array('nombre_tema' => $request->post('tema'),
                        'usuario_id'=>auth()->user()->id,
                    'grado_primaria_id'=>$request->post('idgardo'));
             $resu=temas::where('id',$id)->update($data);
            return json_encode($resu);
        }        
    }

    
}
