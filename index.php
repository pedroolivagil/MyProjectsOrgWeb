<?php
require_once('config.php');
Database::init_db();
Template::getHeader();
?>



<?php
Template::getFooter();
Database::close_db();
?>
