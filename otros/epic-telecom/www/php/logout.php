<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$c = new Client($_SESSION['user_session']);
$c->logout();

header('Location: '._ROOT_PATH_.'home');
?>