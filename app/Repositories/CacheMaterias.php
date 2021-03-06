<?php
namespace App\Repositories;
use App\Repositories\Materias;
use App\Repositories\InterfaceMaterias;
class CacheMaterias implements InterfaceMaterias
{
    protected $materias;
    //constructor
    public function __construct(Materias $materia)
    {
        $this->materias=$materia;
    }
    //traemos las materias y las paginamos
	public function getMaterias($id)
    {
        return $this->materias->getMaterias($id);
    }
    //para guardar la materias
    public function guardar($dato,$url){
        return $this->materias->guardar($dato,$url);
    }

    public function materias_has_escuelas($data){
        return $this->materias->materias_has_escuelas($data);
    }

    public  function materias_has_grados($data){
        return $this->materias->materias_has_grados($data);
    }

    public function Eliminar($id)
    {
        return $this->materias->Eliminar($id);
    }
    public function Actualizar($idmateria,$data,$idgrado,$idgradoAnt)
    {
        return $this->materias->Actualizar($idmateria,$data,$idgrado,$idgradoAnt);
    }
}
?>