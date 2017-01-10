<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EntityManager
 *
 * @author Oliva
 */
class EntityManager implements BasicMethods {

    public function create($params, $table) {
        Database::begin_trans();
        Database::insert($params, $table);
        if (Database::getProblems() == 0) {
            Database::commit_trans();
            return TRUE;
        } else {
            Database::rollBack_trans();
            return FALSE;
        }
    }

    public function delete($params, $table) {
        
    }

    public function update($params, $table) {
        
    }

    public static function findById($id, $table) {
        
    }

}
