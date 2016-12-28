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
    echo "\n- " . Database::getProblems();
    Database::begin_trans();
    $project_home_dir = Database::execute("SELECT p." . COL_DIRECTORIO_ROOT . " FROM " . TABLE_PROYECTO . " p, " . TABLE_USUARIO . " u WHERE p." . COL_ID_PROYECTO . " LIKE '" . $id_proyecto . "' AND u." . COL_ID_USUARIO . " LIKE '" . $id_client . "'");
    $tarjetas = Database::execute("SELECT " . COL_ID_TARJETA . " FROM " . TABLE_REL_PJT_TARJETA . " WHERE " . COL_ID_PROYECTO . " LIKE '" . $id_proyecto . "'");
    $imagenes = Database::execute("SELECT " . COL_ID_IMAGEN . " FROM " . TABLE_REL_PJT_IMAGEN . " WHERE " . COL_ID_PROYECTO . " LIKE '" . $id_proyecto . "'");
    // delete targets
    $arr = array(COL_ID_PROYECTO => $id_proyecto);
    Database::delete(TABLE_PROYECTO, $arr);
    echo "\np " . Database::getProblems();

    if (!is_null($tarjetas)) {
        for ($x = 0; $x < count($tarjetas); $x++) {
            $arr = (array) $tarjetas[$x];
            Database::delete(TABLE_TARJETA, $arr);
            echo "\nt" . $x . ' ' . Database::getProblems();
        }
    }
    //delete pictures
    if (!is_null($imagenes)) {
        for ($x = 0; $x < count($imagenes); $x++) {
            $arr = (array) $imagenes[$x];
            Database::delete(TABLE_IMAGEN, $arr);
            echo "\ni" . $x . ' ' . Database::getProblems();
        }
    }
    if (Database::getProblems() == 0) {
        //hacemos commit
        /* if (Database::commit_trans()) {
          // delete directory
          if (!is_null($project_home_dir)) {
          if (is_dir(ROOT_USER . $id_client . '/' . $project_home_dir[COL_DIRECTORIO_ROOT])) {
          $tools->eliminarDir(ROOT_USER . $id_client . '/' . $project_home_dir[COL_DIRECTORIO_ROOT]);
          }
          }
          $retorno = true;
          } else {
          //hacemos rollback
          Database::rollBack_trans();
          } */
        echo 'todo ok';
    } else {
        //hacemos rollback
        echo "\n- " . Database::getProblems();
        Database::rollBack_trans();
    }
    Database::close_db();
} else {
    Tools::invalidPost($_POST['app']);
}
echo $retorno;
?>

