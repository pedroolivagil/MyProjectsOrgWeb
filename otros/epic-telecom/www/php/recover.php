<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$sms = '';
$nif = $_REQUEST['nif_recover'];
if(Tools::checkIdent($nif) > 0){
	$c = new Client($nif);
	$pass = $c->generatepwd();
	$c->updatePwd($pass[1], true);
	
	$m = new Mail();
	$m->setTo(array($c->getEmail(), $c->getUserName()));
	$m->setBody(Tools::getLocale()->getString('RECOVER_TITLE'),Tools::getMailBodyPwd($c->getUserName(),$pass[0]));
	$m->send();	
	$sms = Tools::getLocale()->getString('RECOVERY_NIF');
	$type = 'success';
}else{
	$sms = Tools::getLocale()->getString('BAD_NIF');
	$type = 'danger';
}
header('Location: '._ROOT_PATH_.'recover-password?type='.$type.'&s='.urlencode($sms));
?>