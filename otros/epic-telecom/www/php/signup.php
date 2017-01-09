<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$nif = $_REQUEST['nif_signup'];
$phone = $_REQUEST['phone_signup'];
$email = $_REQUEST['email_signup'];
$business = $_REQUEST['business_signup'];
$fullname = $_REQUEST['fullname_signup'];
$terminos = $_REQUEST['terminos'];
$url = _ROOT_PATH_.'area-clientes?';
$type = 'danger';
$newClient = new Client();
if($terminos){
	if(Tools::checkIdent($nif) > 0){
		if($newClient->add($nif, $business, $email, $fullname, $phone)){
			$type = 'success';
			$newClient->setMessageError(Tools::getLocale()->getString('NEW_USER_SUCCESS'));
			$url = (!Tools::isEmpty($_REQUEST['url']))? _ROOT_PATH_.$_REQUEST['url'] : $url;
			$newClient->selectUser($nif);
			$newClient->login();
		}
	}else{
		$newClient->setMessageError(Tools::getLocale()->getString('BAD_NIF'));
	$url.= 'type='.$type.'&msg='.urlencode($newClient->getMessageError());
	}
}else{
	$newClient->setMessageError(Tools::getLocale()->getString('ACCEPT_CONDITIONS'));
	$url.= 'type='.$type.'&msg='.urlencode($newClient->getMessageError());
}
header('Location: '.$url);
?>