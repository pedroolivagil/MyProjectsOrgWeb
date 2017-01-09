<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$nif = $_REQUEST['nif_login_page'];
$pass = addslashes($_REQUEST['pass_login_page']);
$autologin = ($_REQUEST['autologin'])?$_REQUEST['autologin']:false;
$url = _ROOT_PATH_.'area-clientes';

$login = new Client($nif);
if($login->isUser($nif)){
	if($login->getPasswd() == Tools::cryptString($pass)){
		$login->login($autologin);
		$url = (!Tools::isEmpty($_REQUEST['url']))? _ROOT_PATH_.$_REQUEST['url'] : $_SERVER['HTTP_REFERER'];
	}else{
		$login->setMessageError(Tools::getLocale()->getString('BAD_USER'));
		$url.= '?type=danger&s='.urlencode($login->getMessageError());
	}
}
header('Location: '.$url);
?>