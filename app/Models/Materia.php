<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Materia extends Model
{
    use HasFactory;
    protected $fillable =[
        'nombremateria','siglasmaterias','urlimagenmat','Eliminarmat'
    ];

    public function escuela()
    {
        return $this->morphedByMany(Escuela::class,'materia');
    }

    public function materiagrado($id)
    {
        $materia=DB::table('materias')
                    ->join('materias_has_grados','materias.id','=','materias_has_grados.materias_id')
                    ->join('grados','grados.id','=','materias_has_grados.grados_id')
                    ->join('materias_has_escuelas','materias.id','=','materias_has_escuelas.materias_id')
                    ->join('escuelas','materias_has_escuelas.escuelas_id','=','escuelas.id')
                    ->select('materias.id','materias.nombremateria','materias.siglasmaterias',
                        'materias.urlimagenmat','materias_has_grados.grados_id','grados.nombregrado')
                    ->where('materias.Eliminarmat',1)
                    ->where('escuelas.id',$id)
                    ->get();
        return $materia;
    }

}
