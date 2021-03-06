<?php
namespace App\Repositories;
use App\Repositories\Escuelas;
use App\Repositories\InterfaceEscuela;
class CacheEscuela implements InterfaceEscuela
{
	protected $escuela;

	function __construct(Escuelas $escuelas)
	{
		$this->escuela=$escuelas;
	}

	public function getEscuela()
	{
		return $this->escuela->getEscuela();
	}

	public function getEscuelas($id){
		return $this->escuela->getEscuelas($id);
	}

	public function guardar($data,$url){
		return $this->escuela->guardar($data,$url);
	}
	public function actulizar($data,$url){
		return $this->escuela->actulizar($data,$url);
	}

	public function actulizarimagen($data){
		return $this->escuela->actulizarimagen($data);
	}
	public function eliminar($data){
            return $this->escuela->eliminar($data);
        }

}
?>