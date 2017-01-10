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
class Project extends PersistenceManager {

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
        $this->id_proyecto = $id_proyecto;
        $this->nombre = $nombre;
        $this->description = $description;
        $this->flag_finish = $flag_finish;
        $this->flag_activo = $flag_activo;
        $this->fecha_creacion = $fecha_creacion;
        $this->fecha_actualizacion = $fecha_actualizacion;
        $this->directorio_root = $directorio_root;
        $this->home_image = $home_image;
        $this->tarjetas = $tarjetas;
        $this->imagenes = $imagenes;
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

}
