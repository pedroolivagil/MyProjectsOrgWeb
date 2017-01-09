<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');
$id = $_REQUEST['id'];
$type = $_REQUEST['type'];
if($type == 'contract'){
	// generamos el enlace del pdf del contrato
	$cl = new Client($_SESSION['user_session']);
	$name = $cl->getNif().'_'.CONTRATO.'_'.$id.'.pdf';
	$f = _USER_PATH_.$cl->getNif().'/files/'.CONTRATO.'_'.$id.'.pdf';
}elseif($type == 'invoice'){
	// generamos el enlace al pdf de la factura
	// cambiamos el codigo para adaptarlo a las facturas
	$cl = new Client($_SESSION['user_session']);
	$name = $cl->getNif().'_'.CONTRATO.'_'.$id.'.pdf';
	$f = _USER_PATH_.$cl->getNif().'/files/'.CONTRATO.'_'.$id.'.pdf';
}else{
	exit;
}
//header("Content-type: application/octet-stream");
header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . $name . "\"\n");
readfile($f);
?>