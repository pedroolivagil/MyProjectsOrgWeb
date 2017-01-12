<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Oliva
 */
interface BasicMethods {

    public function create($params, $table);

    public function delete($table, $newValues, $params);

    public function update($table, $newValues, $params);

    public static function findById($id, $table);
}
