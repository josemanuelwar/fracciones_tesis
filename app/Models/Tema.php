<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Tema extends Model
{
    use HasFactory;

    protected $fillable=['nombre_tema','numerodepreguntas','materias_id'];

    public function getTemas($id)
    {
        $temas=DB::table('temas')
                    ->Join('materias','materias.id','=','temas.materias_id')
                    ->Join('materias_has_grados','materias.id','=','materias_has_grados.materias_id')
                    ->Join('grados','grados.id','=','materias_has_grados.grados_id')
                    ->Join('materias_has_escuelas','materias.id','=','materias_has_escuelas.materias_id')
                    ->where('materias_has_escuelas.escuelas_id',$id)
                    ->select('temas.id','temas.nombre_tema','temas.numerodepreguntas','grados.nombregrado')
                    ->get();
        return $temas;             
    }

    public function updateTema($id,$data)
    {
        $temas=DB::table('temas')->where('id',$id)->update(['numerodepreguntas'=>$data]);
    }
}
