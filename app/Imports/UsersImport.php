<?php

namespace App\Imports;

use App\Models\User;
use App\Models\personas;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /** prosesamos el archivo exel */
        $persona=new personas();
        $persona->Nombre=$row[0];
        $persona->App=$row[1];
        $persona->Apm=$row[2];
        $persona->Direccion=$row[3];
        $persona->Escuela=$row[4];
        $persona->save();
        
        /** recuperamos el id de las persona insertadas */   
        $idpersona = personas::latest('id')->first();
        
        return new User([
            'nombre_usuario' => $row[0],
            'email' => $row[5],
            'password' => Hash::make($row[6]),
            'rol' => 3,
            'persona'=> $idpersona['id'],
            'maestro' => auth()->user()->id
        ]);
    }
}
