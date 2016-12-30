<?php

require_once('Tools.php');
require_once('db/Database.php');

header('Content-type: application/json');
Database::init_db();
echo '{';
echo '"' . PAISES . '":' . Database::preparedQueryToJSON(PaisesFindAll, NULL);
echo '}';
Database::close_db();
?>