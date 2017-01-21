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
class TargetProject extends PersistenceManager implements BasicMethodsEntities {

    //put your code here
    private $id_proyecto;
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

    function getId_proyecto() {
        return $this->id_proyecto;
    }

    function setId_proyecto($id_proyecto) {
        $this->id_proyecto = $id_proyecto;
    }

    public function toArray() {
        return get_object_vars($this);
    }

    public function create() {
        $params = $this->toArray();
        unset($params['id_proyecto']);
        if (parent::getEm()->create($params, TABLE_TARJETA)) {
            $relacion = array(
                COL_ID_PROYECTO => $this->getId_proyecto(),
                COL_ID_TARJETA => $this->getId_target()
            );
            if (parent::getEm()->create($relacion, TABLE_REL_PJT_TARJETA)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function delete() {
        
    }

    public function update() {
        
    }

    public static function findById($id) {
        
    }

}
