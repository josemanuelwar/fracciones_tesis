<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repositories;

/**
 *
 * @author josem
 */
interface InterfacePersona {
    //put your code here
    public function getpersonas($id);
    public function Guardarpersonas($param);
    public function actualizarpersonas($datos,$id,$data);
    public function Eliminar($param);    
}
