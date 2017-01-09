<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');
$cl = new Client($_SESSION['user_session']);
$array = array(
	'nif' => $cl->getNif(),
	'username' => $cl->getUserName(),
	'email' => $cl->getEmail(),
	'phone' => $cl->getPhone(),
	'fullname' => $cl->getFullName()
);
echo json_encode($array);
?>