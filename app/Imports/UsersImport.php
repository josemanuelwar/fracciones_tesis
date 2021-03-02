<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Persona;
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
        $persona=new Persona();
        $persona->nombrecompleto=$row[0];
        $persona->apellido_paterno=$row[1];
        $persona->apellido_materno=$row[2];
        $persona->direccion=$row[3];
        $persona->eliminarper=1;
        $persona->save();
        /** recuperamos el id de las persona insertadas */   
        $idpersona = Persona::latest('id')->first();
        return new User([
            'nombre_usuario' => $row[0],
            'email' => $row[4],
            'password' => Hash::make($row[5]),
            'roles_id' => 3,
            'personas_id'=> $idpersona['id'],
            'users_id' => auth()->user()->id,
            'escuelas_id' => auth()->user()->escuelas_id
        ]);
    }
}
