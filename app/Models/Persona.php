<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombrecompleto',
        'apellido_paterno',
        'apellido_materno',
        'direccion',
        'eliminarper'
    ];


    public function ListaAlumnos($id)
    {
        $alumno=DB::table('personas')
                    ->join('users','personas.id','=','users.personas_id')
                    ->join('escuelas','users.escuelas_id','=','escuelas.id')
                    ->where('users.users_id',$id)
                    ->where('escuelas.Eliminar',1)
                    ->select('personas.id','personas.nombrecompleto','personas.apellido_paterno','personas.apellido_materno','personas.direccion',
                    'users.email','escuelas.nombre_escuela')
                    ->get();
        return $alumno;        
    }

    public function Alumnos($id)
    {
        $alumno=DB::table('personas')
                ->join('users','personas.id','=','users.personas_id')
                ->join('escuelas','users.escuelas_id','=','escuelas.id')
                ->where('personas.id',$id)
                ->where('escuelas.Eliminar',1)
                ->select('personas.id','personas.nombrecompleto','personas.apellido_paterno','personas.apellido_materno','personas.direccion',
                    'users.email','users.escuelas_id')
                    ->get();
        return$alumno;
    }
    public function actualizarAlumno($data,$id,$dato)
    {
        $respuesta=0;
        $alumno=DB::table('personas')
                    ->where('personas.id',$id)
                    ->update($data);
        $usuarios=DB::table('users')
                    ->where('users.personas_id',$id)
                    ->update($dato);
        if($alumno == 1 || $usuarios == 1){
            $respuesta=1;
        }
        
        return $respuesta;
    }

}
