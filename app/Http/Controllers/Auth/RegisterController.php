<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\personas;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'app' => ['required', 'string', 'max:255'],
            'apm' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'escuela' => ['required', 'string', 'max:255'],
            'nikename' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $usuarios = new personas;
        $usuarios->Nombre = $data['nombre'];
        $usuarios->App = $data['app'];
        $usuarios->Apm = $data['apm'];
        $usuarios->Direccion = $data['direccion'];
        $usuarios->Escuela = $data['escuela'];
        $usuarios->save();

        $idpersona = personas::latest('id')->first();
        //  var_dump($idpersona);die;   
        return User::create([
            'nombre_usuario' => $data['nikename'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol' => 2,
            'persona' => $idpersona['id']
        ]);
    }
}
