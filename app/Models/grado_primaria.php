<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grado_primaria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombregrado'
    ];

    public function temas()
    {
        return $this->hasMany(temas::class);
    }
}
