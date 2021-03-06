<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


     // protected $redirectTo = RouteServiceProvider::'/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        # code...
        return view('auth.login');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // sobre escribimos la funcion para redirigir al usuario dependeiendo el rol asignado
    public function redirectPath()
    {
        if (auth()->user()->roles_id === 1) {
            return '';
        }
        if(auth()->user()->roles_id === 2){
            return '/profesor';
        }
        if (auth()->user()->roles_id === 3) {
            return '/alumnosinicio';
        }
    }
}
