<?php

require_once('../Tools.php');
require_once('../db/Database.php');

if ($_POST['id_usuario'] && $_POST['correo']) {
    /*Database::init_db();
    Database::insert(TABLE_USUARIO);
    Database::close_db();*/
    echo $_POST;
} else {
    Tools::invalidPost($_POST['app']);
}
?>