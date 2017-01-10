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

    public function delete($params, $table);

    public function update($params, $table);

    public static function findById($id, $table);
}
