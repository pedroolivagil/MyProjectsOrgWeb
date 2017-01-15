<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Targets
 *
 * @author Oliva
 */
class TargetProject {

    //put your code here
    private $id_target;
    private $label;
    private $valor;
    private $flag_activo;

    function __construct($id_target, $label, $valor, $flag_activo) {
        $this->id_target = $id_target;
        $this->label = $label;
        $this->valor = $valor;
        $this->flag_activo = $flag_activo;
    }

    public static function getNewTarget($target) {
        return new TargetProject($target['id_target'], $target['label'], $target['valor'], $target['flag_activo']);
    }

    function getId_target() {
        return $this->id_target;
    }

    function getLabel() {
        return $this->label;
    }

    function getValor() {
        return $this->valor;
    }

    function getFlag_activo() {
        return $this->flag_activo;
    }

    function setId_target($id_target) {
        $this->id_target = $id_target;
    }

    function setLabel($label) {
        $this->label = $label;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setFlag_activo($flag_activo) {
        $this->flag_activo = $flag_activo;
    }

}
