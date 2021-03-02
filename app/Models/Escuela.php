<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;
    protected $fillabel=[
        'nombre_escuela',
        'direccion',
        'rutaimagen',
        'Eliminar'
    ];

    public function Materia()
    {
        return $this->morphToMany(Materia::class,'escuela');
    }
}
