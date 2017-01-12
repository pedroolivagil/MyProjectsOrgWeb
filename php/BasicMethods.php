<?php
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
