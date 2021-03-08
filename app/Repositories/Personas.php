<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repositories;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
/**
 * Description of Personas
 *
 * @author josem
 */
class Personas implements InterfacePersona {
  
    public function Eliminar($param) {
        
    }

    public function Guardarpersonas($param) {
        /*** gaurdamos en la tabla personas */
        $persona=new Persona();
        $persona->nombrecompleto=$param['nombre'];
        $persona->apellido_paterno=$param['app'];
        $persona->apellido_materno=$param['apm'];
        $persona->direccion=$param['direccion'];
        $persona->eliminarper=1;
        $persona->save();
        $idpersona = Persona::latest('id')->first();
        return $idpersona;
            
    }

    public function actualizarpersonas($datos,$id,$data) {
        $respuesta=0;
        $alumno=DB::table('personas')
                    ->where('personas.id',$id)
                    ->update($datos);
        $usuarios=DB::table('users')
                    ->where('users.personas_id',$id)
                    ->update($data);
        if($alumno == 1 || $usuarios == 1){
            $respuesta=1;
        }
        return $respuesta;   
    }

    public function getpersonas($id) {
        $alumno=DB::table('personas')
                ->join('users','personas.id','=','users.personas_id')
                ->join('escuelas','users.escuelas_id','=','escuelas.id')
                ->where('personas.id',$id)
                ->where('escuelas.Eliminar',1)
                ->select('personas.id','personas.nombrecompleto','personas.apellido_paterno','personas.apellido_materno','personas.direccion',
                    'users.email','users.escuelas_id')
                ->get();
        return $alumno;
    }
    
    public function paginacionAlumnos($id)
    {
        $alumno=DB::table('personas')
                    ->join('users','personas.id','=','users.personas_id')
                    ->join('escuelas','users.escuelas_id','=','escuelas.id')
                    ->where('users.users_id',$id)
                    ->where('escuelas.Eliminar',1)
                    ->select('personas.id','personas.nombrecompleto','personas.apellido_paterno','personas.apellido_materno','personas.direccion',
                    'users.email','escuelas.nombre_escuela')
                    ->paginate(10);
        return $alumno;        
    }

}
