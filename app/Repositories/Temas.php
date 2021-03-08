<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repositories;

/**
 * Description of Temas
 *
 * @author josem
 */
class Temas implements InterfaceTema{
    //put your code here
    public function actualizar($param) {
        
    }

    public function eliminar($param) {
        
    }

    public function gettemas($id) {
        $temas=DB::table('temas')
                    ->Join('materias','materias.id','=','temas.materias_id')
                    ->Join('materias_has_grados','materias.id','=','materias_has_grados.materias_id')
                    ->Join('grados','grados.id','=','materias_has_grados.grados_id')
                    ->Join('materias_has_escuelas','materias.id','=','materias_has_escuelas.materias_id')
                    ->where('materias_has_escuelas.escuelas_id',$id)
                    ->select('temas.id','temas.nombre_tema','temas.numerodepreguntas','grados.nombregrado')
                    ->get();
        return $temas; 
    }

    public function guardar($param) {
        
    }

}
