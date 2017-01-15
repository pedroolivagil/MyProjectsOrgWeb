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
    private $directorio_root;
    private $home_image;
    private $tarjetas;
    private $imagenes;

    function __construct($id_proyecto, $nombre, $description = NULL, $flag_finish = NULL, $flag_activo = NULL, $fecha_creacion = NULL, $fecha_actualizacion = NULL, $directorio_root = NULL, $home_image = NULL, $tarjetas = NULL, $imagenes = NULL) {
        parent::__construct();
        $this->id_proyecto = Tools::toNull($id_proyecto);
        $this->nombre = Tools::toNull($nombre);
        $this->description = Tools::toNull($description);
        $this->flag_finish = Tools::toNull($flag_finish);
        $this->flag_activo = Tools::toNull($flag_activo);
        $this->fecha_creacion = Tools::toNull($fecha_creacion);
        $this->fecha_actualizacion = Tools::toNull($fecha_actualizacion);
        $this->directorio_root = Tools::toNull($directorio_root);
        $this->home_image = Tools::toNull($home_image);
        $this->tarjetas = $tarjetas;
        $this->imagenes = $imagenes;
    }

    public function create() {
        return parent::getEm()->create($this->toArray(), TABLE_PROYECTO);
    }

    public function update() {
        $id = array(COL_ID_USUARIO => $this->getId_usuario());
        return parent::getEm()->update(TABLE_PROYECTO, $this->toArray(), $id);
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
