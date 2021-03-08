<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class Usuarios implements InterfaceUsuario{
    
    public function actualizar($data) {
        
    }

    public function eliminar($data) {
        
    }

    public function gauradarUsuario($data,$id) {
      /**guardamos en la tabla usuarios */
        $usuarios = new User();
        $usuarios->nombre_usuario =$data['nombre'];
        $usuarios->email = $data['email'];
        $usuarios->password = Hash::make($data['password']);
        $usuarios->roles_id = 3;
        $usuarios->personas_id = $id['id'];
        $usuarios->users_id = auth()->user()->id;
        $usuarios->escuelas_id=$data['escuela'];
        $usuarios->save();
        return true;       
    }

    public function getusuario() {
        
    }
    
    public function AsignacioEscuela($idusuario,$idEscuela) {
        $usuarios = new User();
        $actulizar=$usuarios->find($idusuario);
        $actulizar->escuelas_id=$idEscuela;
        $actulizar->save();
    }

}
?>

