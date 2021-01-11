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

    public function ListaTemas()
    {
        $validacion=$request->validate([
            'idgrado' => 'required|max:60',
        ]);
        return json_encode("holas");
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

    public function ListaUsuarios()
    {
        return view('profesor.Listausuarios');
    }

    
}
