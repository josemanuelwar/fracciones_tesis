<?php
namespace App\Repositories;

/**
 * Description of CaheUsuario
 *
 * @author josem
 */
use App\Repositories\Usuarios;
class CaheUsuario implements InterfaceUsuario {
    
    protected $ususrios;
    
    public function __construct(Usuarios $usuario) {
        $this->ususrios=$usuario;
    }

    public function actualizar($data) {
        
    }

    public function eliminar($data) {
        
    }

    public function gauradarUsuario($data,$datos) {
        return $this->ususrios->gauradarUsuario($data,$datos); 
    }

    public function getusuario() {
        
    }
    
    public function AsignacioEscuela($idusuario,$idescuela) {
        return $this->ususrios->AsignacioEscuela($idusuario,$idescuela);
    }

} {
    //put your code here
}
