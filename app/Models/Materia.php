<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

}
