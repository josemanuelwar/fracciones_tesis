<?php
namespace App\Repositories;
use App\Models\Escuela;
use Illuminate\Support\Facades\DB;
class Escuelas implements InterfaceEscuela
{
	public function getEscuela(){
		return Escuela::where('Eliminar',1)->paginate(2);
	}

	public function getEscuelas($id){
		return Escuela::find($id);
	}
        
	public function guardar($validacion,$url){
            $escuela=new Escuela();
            $escuela->nombre_escuela=$validacion['escuela'];
            $escuela->direccion=$validacion['direccion'];
            $escuela->rutaimagen=$url;
            $escuela->Eliminar=1;
            $escuela->save();
        return true;
	}
	public function actulizar($validacion,$url){
            $escuela = new Escuela();
            $actualizar = $escuela->find($validacion['idEscuela']);
            $actualizar->nombre_escuela = $validacion['escuelaeditar'];
            $actualizar->direccion = $validacion['direccionediatra'];
            $actualizar->rutaimagen = $url;
            $actualizar->save();
        }

	public function actulizarimagen($validacion){
            $escuela=new Escuela();
            $actualizar=$escuela->find($validacion['idEscuela']);
            $actualizar->nombre_escuela=$validacion['escuelaeditar'];
            $actualizar->direccion=$validacion['direccionediatra'];
            $actualizar->save();

	}
	public function eliminar($validation){
            $escuela=new Escuela();
            $actualizar=$escuela->find($validacion['escuelaid']);
            $actualizar->Eliminar=0;
            $actualizar->save();
            
        }


}
?>