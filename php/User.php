<?php

/**
 * Description of User
 *
 * @author 0013856
 */
class User {

    public $id_usuario;
    public $correo;
    public $user_pass;
    public $fecha_alta;
    public $flag_activo;
    public $nif;
    public $telefono;
    public $id_pais;
    public $poblacion;

    function __construct($id_usuario, $correo, $user_pass, $nif = null, $telefono = null, $id_pais = null, $poblacion = null) {
        $this->id_usuario = $id_usuario;
        $this->correo = $correo;
        $this->user_pass = $user_pass;
        $this->fecha_alta = $fecha_alta;
        $this->flag_activo = $flag_activo;
        $this->nif = $nif;
        $this->telefono = $telefono;
        $this->id_pais = $id_pais;
        $this->poblacion = $poblacion;
    }

    public function create() {
        
    }

}
