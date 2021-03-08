<?php
namespace App\Repositories;

interface InterfaceUsuario{
   public function getusuario();
   public function  gauradarUsuario($data,$dato);
   public function actualizar($data);
   public function eliminar($data);
}
?>
