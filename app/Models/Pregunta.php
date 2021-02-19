<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pregunta extends Model
{
    use HasFactory;
    protected $fillable=['reactivo','nivel','temas_id'];

    public function getpreres($id)
    {
        $res=DB::table('preguntas')
                ->join('respuestas','respuestas.preguntas_id','=','preguntas.id')
                ->where('preguntas.id',$id)
                ->get();
        return $res;        
    }

}
