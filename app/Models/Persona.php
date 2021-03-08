<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombrecompleto',
        'apellido_paterno',
        'apellido_materno',
        'direccion',
        'eliminarper'
    ];

}