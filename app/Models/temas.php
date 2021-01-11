<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temas extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombre_tema',
        'usuario_id',
        'grado_primaria_id'
    ];
    
    public function Grados()
    {
        return $this->hasOne(grado_primaria::class);
    }


}
