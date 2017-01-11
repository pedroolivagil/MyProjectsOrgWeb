<?php

require_once('Tools.php');
require_once('db/Database.php');

header('Content-type: text/html');
//header('Content-type: application/json');
Database::init_db();
echo "olivadevelop@gmail.com<br />";
echo '<br />' . Tools::cryptpass("1234") . ' (' . strlen(Tools::cryptpass("1234")).')';
echo '<br />' . Tools::cryptpass(1234) . ' (' . strlen(Tools::cryptpass(1234)).')';
Database::close_db();
?>