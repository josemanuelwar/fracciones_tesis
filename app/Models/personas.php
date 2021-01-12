<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class personas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nombre',
        'App',
        'Apm',
        'Direccion',
        'Escuela'
    ];

    public function listaAlumnos($var)
    {
        $alumno = DB::table('personas')
                    ->join('users', 'personas.id', '=', 'users.persona')
                    ->where('users.maestro',$var)
                    ->select('personas.id', 'personas.Nombre','personas.App',
                    'personas.Apm','personas.Apm','personas.Direccion','personas.Escuela','users.email')
                    ->get();
        return $alumno;
    }

}
