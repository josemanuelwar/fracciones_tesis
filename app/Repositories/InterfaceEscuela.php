<?php
namespace App\Repositories;
interface InterfaceEscuela
{
	public function getEscuela();
	public function guardar($data,$url);
	public function actulizar($data,$url);
	public function eliminar($data);
	public function getEscuelas($id);
}
?>