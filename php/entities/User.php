<?php

/**
 * Description of User
 *
 * @author 0013856
 */
class User extends PersistenceManager implements BasicMethodsEntities {

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

    function __construct($id_usuario, $correo, $user_pass, $fullname, $nif = null, $birth_date = null, $telefono = null, $id_pais = null, $poblacion = null, $flag_activo = NULL, $fecha_alta = NULL) {
        parent::__construct();
        $this->id_usuario = Tools::toNull($id_usuario);
        $this->correo = Tools::toNull($correo);
        $this->user_pass = Tools::toNull($user_pass);
        $this->fecha_alta = Tools::toNull($fecha_alta);
        $this->flag_activo = Tools::toNull($flag_activo);
        $this->nif = Tools::toNull($nif);
        $this->fullname = Tools::toNull($fullname);
        $this->birth_date = Tools::toNull($birth_date);
        $this->telefono = Tools::toNull($telefono);
        $this->setId_pais(Tools::toNull($id_pais));
        $this->poblacion = Tools::toNull($poblacion);
    }

    public function create() {
        return parent::getEm()->create($this->toArray(), TABLE_USUARIO);
    }

    public function update() {
        $id = array(COL_ID_USUARIO => $this->getId_usuario());
        return parent::getEm()->update(TABLE_USUARIO, $this->toArray(), $id);
    }

    public function delete() {
        $id = array(COL_ID_USUARIO => $this->getId_usuario());
        return parent::getEm()->delete(TABLE_USUARIO, $this->toArray(), $id);
    }

    public static function findById($id) {
        /* return User with user id data */
        $params = array(
            COL_ID_USUARIO => $id
        );
        $usuario = Database::preparedQuery(UsuarioFindById, $params);
        return new User($usuario[0][COL_ID_USUARIO], $usuario[0]['correo'], $usuario[0]['user_pass'], $usuario[0]['fullname'], $usuario[0]['nif'], $usuario[0]['birth_date'], $usuario[0]['telefono'], $usuario[0]['id_pais'], $usuario[0]['poblacion'], $usuario[0]['flag_activo'], $usuario[0]['fecha_alta']);
    }

    public function getProjectById($id) {
        /* return User with user id data */
        $params = array(
            COL_ID_USUARIO => $this->id_usuario,
            COL_ID_PROYECTO => $id
        );
        $proyecto = Database::preparedQuery(ProyectoFindById, $params);
        $tarjetas = Database::preparedQuery(TarjetasFindAllById, $params);
        $imagenes = Database::preparedQuery(ImagenesFindAllById, $params);
        return new Project($proyecto[0]['id_proyecto'], $proyecto[0]['nombre'], $proyecto[0]['description'], $proyecto[0]['flag_finish'], $proyecto[0]['flag_activo'], $proyecto[0]['fecha_creacion'], $proyecto[0]['fecha_actualizacion'], $proyecto[0]['directorio_root'], $proyecto[0]['home_image'], $tarjetas, $imagenes);
    }

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

    public function countProjects() {
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

    function getBirth_date() {
        return $this->birth_date;
    }

    function getFullname() {
        return $this->fullname;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = parent::updateField($this->id_usuario, $id_usuario);
    }

    function setCorreo($correo) {
        $this->correo = parent::updateField($this->correo, $correo);
    }

    function setUser_pass($user_pass) {
        $this->user_pass = parent::updateField($this->user_pass, $user_pass);
    }

    function setFecha_alta($fecha_alta) {
        $this->fecha_alta = parent::updateField($this->fecha_alta, $fecha_alta);
    }

    function setFlag_activo($flag_activo) {
        $this->flag_activo = parent::updateField($this->flag_activo, $flag_activo);
    }

    function setNif($nif) {
        $this->nif = parent::updateField($this->nif, $nif);
    }

    function setTelefono($telefono) {
        $this->telefono = parent::updateField($this->telefono, $telefono);
    }

    function setId_pais($id_pais) {
        if (is_null($id_pais)) {
            $id_pais = 0;
        }
        $this->id_pais = $id_pais;
    }

    function setPoblacion($poblacion) {
        $this->poblacion = parent::updateField($this->poblacion, $poblacion);
    }

    function setBirth_date($birth_date) {
        $this->birth_date = parent::updateField($this->birth_date, $birth_date);
    }

    function setFullname($fullname) {
        $this->fullname = parent::updateField($this->fullname, $fullname);
    }

    public function toArray() {
        return get_object_vars($this);
    }

}
