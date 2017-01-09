<?php

require_once('Tools.php');
require_once('db/Database.php');

//header('Content-type: application/json');
header('Content-type: text/html');
echo '{';
Database::init_db();
$result = Database::preparedQueryToJSON(UsuarioFindById, array("id_usuario" => "d6edfbf0a46a571cf0562daf23d90e81"));
echo '"usuario" : ' . $result . ",";
$result = Database::preparedQueryToJSON(ProyectoFindById, array("id_proyecto" => "1"));
echo '"Proyectos" : ' . $result . ",";
$result = Database::preparedQueryToJSON(TarjetasFindAllById, array("id_usuario" => "d6edfbf0a46a571cf0562daf23d90e81", "id_proyecto" => "1"));
echo '"Tarjetas" : ' . $result . ",";
$result = Database::preparedQueryToJSON(ImagenesFindAllById, array("id_usuario" => "d6edfbf0a46a571cf0562daf23d90e81", "id_proyecto" => "1"));
echo '"Imagenes" : ' . $result;
Database::close_db();
echo '}';
?>