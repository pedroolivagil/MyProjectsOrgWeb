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

}
