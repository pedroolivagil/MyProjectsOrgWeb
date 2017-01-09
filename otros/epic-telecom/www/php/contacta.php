<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$email = $_REQUEST['email_contact'];
$name = $_REQUEST['name_contact'];
$phone = $_REQUEST['phone_contact'];
$address = $_REQUEST['address_contact'];
$service = implode(';',$_REQUEST['service_contact']);
$coment = $_REQUEST['coment_contact'];
$submit = $_REQUEST['submit_contact'];

if(!Tools::isEmpty($submit)){
	if(!(Tools::isEmpty($email) 
	and Tools::isEmpty($name) 
	and Tools::isEmpty($phone) 
	and Tools::isEmpty($address) 
	and Tools::isEmpty($service) 
	and Tools::isEmpty($coment))){
		$sql = Tools::getDB()->query('SELECT MAX(id) FROM contact_form');
		$idQuery = $sql->fetch_row();
		$m = new Mail();
		$m->setTo(array($email,$name),true);
		$m->setBody('Consulta abierta: Nº '.($idQuery[0]+1).'', Tools::getMailBodyContact($name,$coment));
		if($m->send()){
			Tools::getDB()->query('INSERT INTO contact_form(fullname,email,phone,address,service,coments) VALUES("'.$name.'","'.$email.'","'.$phone.'","'.$address.'","'.$service.'","'.$coment.'")');
			header('Location: '._ROOT_PATH_.'contacto?type=success&s='.urlencode(Tools::getLocale()->getString('SENDMAIL_SUCCESS')));
		}else{
			header('Location: '._ROOT_PATH_.'contacto?type=danger&s='.urlencode(Tools::getLocale()->getString('SENDMAIL_FAIL')));
		}
	}else{
		header('Location: '._ROOT_PATH_.'contacto?type=danger&s='.urlencode(Tools::getLocale()->getString('SENDMAIL_FAIL')));
	}
}else{
	header('Location: '._ROOT_PATH_.'contacto');
}
?>