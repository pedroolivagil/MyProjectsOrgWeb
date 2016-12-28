<?php

/* obtenemos todos los datos del cliente y lo devolvemos como un JSON */
require_once('../Tools.php');
require_once('../db/Database.php');

header('Content-type: application/json');
// get solo para el desarrollo
if ($_POST['id_usuario'] && $_POST['id_proyecto']) {
    $params = array("id_usuario" => $_POST['id_usuario'], "id_proyecto" => $_POST['id_proyecto']);
    echo '{';
    Database::init_db();
    echo '"' . PROYECTOS_USUARIO . '":' . Database::preparedQueryToJSON(ProyectoFindById, $params);
    echo ',"' . TARJETAS_PROYECTO . '":' . Database::preparedQueryToJSON(TarjetasFindAllById, $params);
    echo ',"' . IMAGENES_PROYECTO . '":' . Database::preparedQueryToJSON(ImagenesFindAllById, $params);
    Database::close_db();
    echo '}';
} else {
    Tools::invalidPost($_POST['app']);
}
?>