<?php

require_once('Tools.php');
require_once('db/Database.php');

header('Content-type: text/html');
//header('Content-type: application/json');
Database::init_db();
echo "olivadevelop@gmail.com<br />";
echo Tools::encrypt("olivadevelop@gmail.com");
Database::close_db();
?>