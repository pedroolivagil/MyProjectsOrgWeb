<?php

/* obtenemos todos los datos del cliente y lo devolvemos como un JSON */
require_once('../Tools.php');
require_once('../db/Database.php');

header('Content-type: application/json');
// get solo para el desarrollo
if ($_POST['id_usuario']) {
    $params = array("id_usuario" => $_POST['id_usuario']);
    echo '{';
    Database::init_db();
    echo '"' . USUARIO . '":' . Database::preparedQueryToJSON(UsuarioFindById, $params);
    Database::close_db();
    echo '}';
} else {
    Tools::invalidPost($_POST['app']);
}
?>