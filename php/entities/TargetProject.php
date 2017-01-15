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

    function __construct($id_target, $label, $valor) {
        $this->id_target = $id_target;
        $this->label = $label;
        $this->valor = $valor;
    }

    public static function getNewTarget($target) {
        return new TargetProject($target['id_target'], $target['label'], $target['valor']);
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

    function setId_target($id_target) {
        $this->id_target = $id_target;
    }

    function setLabel($label) {
        $this->label = $label;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

}
