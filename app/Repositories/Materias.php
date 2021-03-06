<?php
namespace App\Repositories;
use App\Models\Materia;
use Illuminate\Support\Facades\DB;
class Materias implements InterfaceMaterias
{

	public function getMaterias($id)
    {
        # code...
        $materia=DB::table('materias')
            ->join('materias_has_grados','materias.id','=','materias_has_grados.materias_id')
            ->join('grados','grados.id','=','materias_has_grados.grados_id')
            ->join('materias_has_escuelas','materias.id','=','materias_has_escuelas.materias_id')
            ->join('escuelas','escuelas.id','=','materias_has_escuelas.escuelas_id')
            ->where('escuelas.id',$id)
            ->where('Eliminarmat',1)
            ->select('materias.id','materias.nombremateria','materias.siglasmaterias','materias.urlimagenmat','materias_has_grados.grados_id','grados.nombregrado')
            ->paginate(2);
        return $materia;
    }
    // guardamos la materias
    public function guardar($dato,$url)
    {
    	/** creamos objetos de los modelos y guardamos los datos  */
        $materia=new Materia();
        $materia->nombremateria=$dato['materia'];
        $materia->siglasmaterias = $dato['abrebiatura'];
        $materia->urlimagenmat=$url;
        $materia->Eliminarmat=1;
        $materia->save();
        return $materiaid=Materia::latest('id')->first();
    }

    public function materias_has_escuelas($data)
    {
    	$res=DB::table('materias_has_escuelas')->insert($data);
    	return $res;
    }

    public function materias_has_grados($data)
    {
    	$res1=DB::table('materias_has_grados')->insert($data);
    	return $res1;
    }

    public function Eliminar($id)
    {
    	$mat=new Materia();
        $elim=$mat->find($id['materiaid']);
        $elim->Eliminarmat=0;
        $elim->save();
    }

    public function Actualizar($idmateria,$data,$idgrado,$idgradoAnt)
    {
    	 $updateMat=DB::table('materias')
                    ->where('id',$idmateria)
                    ->update($data);
	       $updateGra=DB::table('materias_has_grados')
	                            ->where('materias_id',$idmateria)
	                            ->where('grados_id',$idgradoAnt)
	                            ->update(['grados_id'=>$idgrado]);
	        if($updateMat == true || $updateGra == true){
	            return true;
	        }
	        else return false;
    }
}
?>