<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;
    protected $fillabel=['nombregrado'];

    public function materia()
    {
                # code...
        return $this->morphToMany(Materia::class,'materias');
    }
}
