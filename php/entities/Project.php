<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Project
 *
 * @author 0013856
 */
class Project extends PersistenceManager implements BasicMethodsEntities {

    private static $id_usuario;
    private $id_proyecto;
    private $nombre;
    private $description;
    private $flag_finish;
    private $flag_activo;
    private $fecha_creacion;
    private $fecha_actualizacion;
//    private $directorio_root;
//    private $home_image;
    // array multidimesional asociativo con los valores clave identicos a las propiedades de la clase
    private $tarjetas;
    // array multidimesional asociativo con los valores clave identicos a las propiedades de la clase
    private $imagenes;

    function __construct($id_proyecto, $nombre, $description = NULL, $flag_finish = NULL, $flag_activo = NULL, $fecha_creacion = NULL, $fecha_actualizacion = NULL, $tarjetas = NULL, $imagenes = NULL) {
        parent::__construct();
        $this->id_proyecto = $id_proyecto;
        $this->nombre = $nombre;
        $this->description = $description;
        $this->flag_finish = $flag_finish;
        $this->flag_activo = $flag_activo;
        $this->fecha_creacion = $fecha_creacion;
        $this->fecha_actualizacion = $fecha_actualizacion;
        $this->tarjetas = $tarjetas;
        $this->imagenes = $imagenes;
    }

    public function create() {
        $errors = 0;
        $params = $this->toArray();
        unset($params['tarjetas'], $params['imagenes']);
        if (parent::getEm()->create($params, TABLE_PROYECTO)) {
            Tools::crearDirs(_CLIENT_PATH_ . Tools::getCookie(SESSION_USUARIO_ID));
            Tools::crearDirs(_CLIENT_PATH_ . Tools::getCookie(SESSION_USUARIO_ID) . '/' . $this->getId_proyecto());
            Tools::crearDirs(_CLIENT_PATH_ . Tools::getCookie(SESSION_USUARIO_ID) . '/' . $this->getId_proyecto() . '/' . _USER_IMG_PATH_);
            $params = array(
                COL_ID_PROYECTO => $this->getId_proyecto(),
                COL_ID_USUARIO => Tools::getCookie(SESSION_USUARIO_ID)
            );
            if (parent::getEm()->create($params, TABLE_REL_PJT_USUARIO)) {
                if ($this->getTarjetas() != NULL && count($this->getTarjetas()) > 0) {
                    foreach ($this->getTarjetas() as $tarjet) {
                        //$t = new TargetProject($this->getId_proyecto(), $tarjet->getId_tarjeta(), $tarjet->getLabel(), $tarjet->getValor(), $tarjet->getFlag_activo());
                        if (!$tarjet->create()) {
                            $errors++;
                        }
                    }
                }
                if ($this->getImagenes() != NULL && count($this->getImagenes()) > 0) {
                    foreach ($this->getImagenes() as $imagen) {
                        //$i = new ImageProject($this->getId_proyecto(), $imagen->getId_imagen(), $imagen->getUrl(), $imagen->getDescripcion(), $imagen->getWidth(), $imagen->getHeight(), NULL, 1, $imagen->getHeader());
                        if ($imagen->create()) {
                            if (!$imagen->upload(Tools::getCookie(SESSION_USUARIO_ID))) {
                                $errors++;
                            }
                        } else {
                            $errors++;
                        }
                    }
                }
            }
        }
        if ($errors == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update() {
        $id = array(COL_ID_USUARIO => $this->getId_usuario());
        $params = $this->toArray();
        unset($params['tarjetas'], $params['imagenes']);
        return parent::getEm()->update(TABLE_PROYECTO, $params, $id);
    }

    public function delete() {
        $id = array(COL_ID_PROYECTO => $this->getId_proyecto());
        $params = $this->toArray();
        unset($params['tarjetas'], $params['imagenes']);
        return parent::getEm()->delete(TABLE_PROYECTO, $params, $id);
    }

    public static function findById($id) {
        /* return User with user id data */
        $params = array(
            COL_ID_USUARIO => self::getId_usuario(),
            COL_ID_PROYECTO => $id
        );
        $proyecto = Database::preparedQuery(ProyectoFindById, $params);
        return new Project($proyecto[0]['id_proyecto'], $proyecto[0]['nombre'], $proyecto[0]['description'], $proyecto[0]['flag_finish'], $proyecto[0]['flag_activo'], $proyecto[0]['fecha_creacion'], $proyecto[0]['fecha_actualizacion'], $proyecto[0]['directorio_root'], $proyecto[0]['home_image'], NULL, NULL);
    }

    function getHomeImg($id) {
        return _USER_PATH_ . $id . '/' . $this->getId_proyecto() . '/' . $this->getHome_image();
    }

    function getUrlImg($id) {
        return _USER_PATH_ . $id . '/' . $this->getId_proyecto() . '/' . _USER_IMG_PATH_ . '/';
    }

    function getId_proyecto() {
        return $this->id_proyecto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescription() {
        return $this->description;
    }

    function getFlag_finish() {
        return $this->flag_finish;
    }

    function getFlag_activo() {
        return $this->flag_activo;
    }

    function getFecha_creacion() {
        return $this->fecha_creacion;
    }

    function getFecha_actualizacion() {
        return $this->fecha_actualizacion;
    }

    function getDirectorio_root() {
        return $this->directorio_root;
    }

    function getHome_image() {
        return $this->home_image;
    }

    function getTarjetas() {
        return $this->tarjetas;
    }

    function getImagenes() {
        return $this->imagenes;
    }

    static function getId_usuario() {
        return self::$id_usuario;
    }

    function setId_proyecto($id_proyecto) {
        $this->id_proyecto = $id_proyecto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setFlag_finish($flag_finish) {
        $this->flag_finish = $flag_finish;
    }

    function setFlag_activo($flag_activo) {
        $this->flag_activo = $flag_activo;
    }

    function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    function setFecha_actualizacion($fecha_actualizacion) {
        $this->fecha_actualizacion = $fecha_actualizacion;
    }

    function setDirectorio_root($directorio_root) {
        $this->directorio_root = $directorio_root;
    }

    function setHome_image($home_image) {
        $this->home_image = $home_image;
    }

    function setTarjetas($tarjetas) {
        $this->tarjetas = $tarjetas;
    }

    function setImagenes($imagenes) {
        $this->imagenes = $imagenes;
    }

    static function setId_usuario($id_usuario) {
        self::$id_usuario = $id_usuario;
    }

    public function toArray() {
        return get_object_vars($this);
    }

}
