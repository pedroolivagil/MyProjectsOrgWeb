<?php

/**
 * Description of User
 *
 * @author 0013856
 */
class User {

    private $id_usuario;
    private $correo;
    private $user_pass;
    private $fecha_alta;
    private $fullname;
    private $birth_date;
    private $flag_activo;
    private $nif;
    private $telefono;
    private $id_pais;
    private $poblacion;

    function __construct($id_usuario, $correo, $user_pass, $fullname, $nif = null, $birth_date = null, $telefono = null, $id_pais = null, $poblacion = null) {
        $this->id_usuario = $id_usuario;
        $this->correo = $correo;
        $this->user_pass = $user_pass;
        $this->fecha_alta = $fecha_alta;
        $this->flag_activo = $flag_activo;
        $this->nif = $nif;
        $this->fullname = $fullname;
        $this->birth_date = $birth_date;
        $this->telefono = $telefono;
        $this->id_pais = $id_pais;
        $this->poblacion = $poblacion;
    }

    public function create() {
        $data = (array) json_decode(json_encode($this, TRUE));
        Database::begin_trans();
        Database::insert($data, TABLE_USUARIO);
        if (Database::getProblems() == 0) {
            Database::commit_trans();
            return TRUE;
        } else {
            Database::rollBack_trans();
            return FALSE;
        }
    }

    public function update(Usuario $usuario) {
        
    }

    public function delete(Usuario $usuario) {
        
    }

    /* return User with user id data */

    public static function findById($id) {
        $params = array(
            COL_ID_USUARIO => $id
        );
        $usuario = Database::preparedQuery(UsuarioFindById, $params);
        return new User($usuario[0][COL_ID_USUARIO], $usuario[0]['correo'], '', $usuario[0]['fullname'], $usuario[0]['nif'], $usuario[0]['birth_date'], $usuario[0]['telefono'], $usuario[0]['id_pais'], $usuario[0]['poblacion']);
    }

    /* return User with user id data */

    public function getAllProjects() {
        $params = array(
            COL_ID_USUARIO => $this->id_usuario
        );
        $proyectos = array();
        $query = Database::preparedQuery(ProyectosFindAllById, $params);
        if (!is_null($query)) {
            foreach ($query as $proyecto) {
                $proyect = new Project($proyecto['id_proyecto'], $proyecto['nombre'], $proyecto['description'], $proyecto['flag_finish'], $proyecto['flag_activo'], $proyecto['fecha_creacion'], $proyecto['fecha_actualizacion'], $proyecto['directorio_root'], $proyecto['home_image']);
                array_push($proyectos, $proyect);
            }
        }
        return $proyectos;
    }
    
    public function countProjects(){
        return count($this->getAllProjects());
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

    function getBirth_date() {
        return $this->birth_date;
    }

    function setBirth_date($birth_date) {
        $this->birth_date = $birth_date;
    }

    function getFullname() {
        return $this->fullname;
    }

    function setFullname($fullname) {
        $this->fullname = $fullname;
    }

}
