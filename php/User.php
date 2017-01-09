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
        //Database::begin_trans();
        
        //Database::insert($arrayFieldsValues, TABLE_USUARIO);
        var_dump(serialize($this));
    }

    public function update(Usuario $usuario) {
        
    }
    
    public function delete(Usuario $usuario){
        
    }
            
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getUser_pass() {
        return $this->user_pass;
    }

    function getFecha_alta() {
        return $this->fecha_alta;
    }

    function getFlag_activo() {
        return $this->flag_activo;
    }

    function getNif() {
        return $this->nif;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getId_pais() {
        return $this->id_pais;
    }

    function getPoblacion() {
        return $this->poblacion;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setUser_pass($user_pass) {
        $this->user_pass = $user_pass;
    }

    function setFecha_alta($fecha_alta) {
        $this->fecha_alta = $fecha_alta;
    }

    function setFlag_activo($flag_activo) {
        $this->flag_activo = $flag_activo;
    }

    function setNif($nif) {
        $this->nif = $nif;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setId_pais($id_pais) {
        $this->id_pais = $id_pais;
    }

    function setPoblacion($poblacion) {
        $this->poblacion = $poblacion;
    }



}
