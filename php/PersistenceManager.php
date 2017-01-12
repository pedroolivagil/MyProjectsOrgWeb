<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersistenceManager
 *
 * @author Oliva
 */
class PersistenceManager {

    private $em;

    function __construct() {
        $this->em = new EntityManager();
    }

    protected function getEm() {
        return $this->em;
    }
    
    protected function updateField($field, $value, $nullable = FALSE){
        $newVal = '';
        if($value != $field){
            if($nullable){
                if(is_null($value) || empty($value)){
                    $newVal = NULL;
                }  else {
                    $newVal = $value;                    
                }
            }  else {
                $newVal = $value;
            }
        }else{
            $newVal = $field;
        }
        return $newVal;
    }
    
}
