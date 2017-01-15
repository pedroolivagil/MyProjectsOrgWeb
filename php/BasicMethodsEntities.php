<?php

/**
 * Description of BasicMethodsEntities
 *
 * @author 0013856
 */
interface BasicMethodsEntities {

    public function create();

    public function update();

    public function delete();

    public static function findById($id);

    public function toArray();
}
