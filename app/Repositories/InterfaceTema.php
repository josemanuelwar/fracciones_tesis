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
interface InterfaceTema {
    //put your code here
    
    public function gettemas($param);
    public function guardar($param);
    public function actualizar($param);
    public function eliminar($param);
}
