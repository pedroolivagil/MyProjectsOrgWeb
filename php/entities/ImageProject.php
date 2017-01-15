<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImageProject
 *
 * @author Oliva
 */
class ImageProject extends PersistenceManager implements BasicMethodsEntities {

    //put your code here
    private $id_imagen;
    private $url;
    private $descripcion;
    private $width;
    private $height;
    private $fecha_subida;
    private $flag_activo;

    function __construct($id_imagen, $url, $descripcion, $width, $height, $fecha_subida, $flag_activo) {
        $this->id_imagen = $id_imagen;
        $this->url = $url;
        $this->descripcion = $descripcion;
        $this->width = $width;
        $this->height = $height;
        $this->fecha_subida = $fecha_subida;
        $this->flag_activo = $flag_activo;
    }

    static function getNewImage($img) {
        return new ImageProject($img['id_imagen'], $img['url'], $img['descripcion'], $img['width'], $img['height'], $img['fecha_subida'], $img['flag_activo']);
    }

    function getId_imagen() {
        return $this->id_imagen;
    }

    function getUrl() {
        return $this->url;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getWidth() {
        return $this->width;
    }

    function getHeight() {
        return $this->height;
    }

    function getFecha_subida() {
        return $this->fecha_subida;
    }

    function getFlag_activo() {
        return $this->flag_activo;
    }

    function setId_imagen($id_imagen) {
        $this->id_imagen = $id_imagen;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setWidth($width) {
        $this->width = $width;
    }

    function setHeight($height) {
        $this->height = $height;
    }

    function setFecha_subida($fecha_subida) {
        $this->fecha_subida = $fecha_subida;
    }

    function setFlag_activo($flag_activo) {
        $this->flag_activo = $flag_activo;
    }

    public function toArray() {
        return get_object_vars($this);        
    }

    public function create() {
        
    }

    public function delete() {
        
    }

    public function update() {
        
    }

    public static function findById($id) {
        
    }

}
