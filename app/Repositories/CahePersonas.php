<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repositories;
use App\Repositories\Personas;
/**
 * Description of CahePersonas
 *
 * @author josem
 */
class CahePersonas implements InterfacePersona {
    //put your code here
    protected $persona;
    public function __construct(Personas $personas) {
        $this->persona=$personas;
    }
    public function Eliminar($param) {
        
    }

    public function Guardarpersonas($param) {
        return $this->persona->Guardarpersonas($param);
    }

    public function actualizarpersonas($datos,$id,$data) {
        return $this->persona->actualizarpersonas($datos, $id, $data);
    }

    public function getpersonas($id) {
        return $this->persona->getpersonas($id);
    }
    
    public function paginacionAlumnos($id)
    {
        return $this->persona->paginacionAlumnos($id);        
    }

}
