<?php

require_once('../../config.php');
error_reporting(1);
Database::init_db();
$finalPage = 'signup-finish';
echo '<br />' . $user = $_POST['login_email'];
echo '<br />' . $pass = $_POST['password_login'];
if ($user != NULL && $pass != NULL) {
}
Database::close_db();
//header("Location: " . $finalPage);
?>
