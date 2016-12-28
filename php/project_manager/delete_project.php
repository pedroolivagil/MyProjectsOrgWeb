<?php

/* Created By: OlivaDevelop
 * Author: Pedro Oliva Gil
 * Copyright 2016
 * 
 * Actualizamos el fichero projects del usuario con los proyectos nuevos
 */
require_once('../Tools.php');
error_reporting(E_ALL ^ E_NOTICE);
require_once('../db/Database.php');
header('Content-type: text/plain');
$tools = new Tools();
$retorno = FALSE;
$id_client = $_REQUEST['id_usuario'];
$id_proyecto = $_REQUEST['id_proyecto'];

if (!is_null($id_client) && !is_null($id_proyecto)) {
    Database::init_db();
    Database::begin_trans();

    $newVal = array(COL_FLAG_ACTIVO => '0');
    $params = array(COL_ID_PROYECTO => $id_proyecto);
    Database::update(TABLE_PROYECTO, $newVal, $params);
    if (Database::getProblems() == 0) {
        //hacemos commit
        if (Database::commit_trans()) {
            $retorno = TRUE;
        }
    } else {
        //hacemos rollback
        Database::rollBack_trans();
    }
    Database::close_db();
} else {
    Tools::invalidPost($_POST['app']);
}
echo $retorno;
?>

