<?php
namespace App\Repositories;

interface InterfaceMaterias
{
	public function getMaterias($id);
	public function guardar($dato,$url);
	public function Eliminar($id);
	public function Actualizar($idmateria,$data,$idgrado,$idgradoAnt);

}
?>