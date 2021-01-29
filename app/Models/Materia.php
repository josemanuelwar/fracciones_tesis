<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Materia extends Model
{
    use HasFactory;
    protected $fillable =[
        'nombremateria','siglasmaterias'
    ];

    public function escuela()
    {
        return $this->morphedByMany(Escuela::class,'materia');
    }
    public function getMaterias($id)
    {
        # code...
        $materia=DB::table('materias')
            ->join('materias_has_grados','materias.id','=','materias_has_grados.materias_id')
            ->join('grados','grados.id','=','materias_has_grados.grados_id')
            ->join('materias_has_escuelas','materias.id','=','materias_has_escuelas.materias_id')
            ->join('escuelas','escuelas.id','=','materias_has_escuelas.escuelas_id')
            ->where('escuelas.id',$id)
            ->select('materias.id','materias.nombremateria','materias.siglasmaterias','materias_has_grados.grados_id','grados.nombregrado')
            ->get();
        return $materia;    
    }

    public function actualizarMateria($idmateria,$data,$idgrado,$idgradoAnt)
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
