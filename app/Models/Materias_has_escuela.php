<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias_has_escuela extends Model
{
    use HasFactory;
    protected $table="materias_has_escuelas";
    protected $fillabel=['materias_id','escuelas_id'];

    public function materia()
    {
       return $this->morphedByMany(Materia::class,'materias');
    }

    public function Escuela()
    {
        # code...
        return $this->morphedByMany(Escuela::class,'escuelas_id');
    }

}
