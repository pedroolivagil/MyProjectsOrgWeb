<?php
if(!$_REQUEST['b']){
	header('Location: home');
	exit;
}

require_once('../config.php');
require_once(_CLASS_PATH_.'Loads.php');

/* rellenamos la plantilla */
$f_scripts = "<script>fillCaptionText(['".Tools::getLocale()->getString('INDEX_BREADCRUMP')."','".Tools::getLocale()->getString('SUCCESSCART_BREADCRUMP')."']); changeCaptionImg('"._IMAGE_PATH_."caption/bg8.jpg');actUserBar();</script>";

$preview = Tools::separator();
$content.= '
<br />
<blockquote class="gray well bg-white margin50LR">
    <p>Si es la primera vez que contrata un servicio en <strong>EPIC TELECOM</strong> debe saber:</p>
    <ul class="fnt-90 ul-pad">
        <li>Recibirá un correo con los datos de usuario. Reviselos y verifique el correo mediante el enlace insertado en dicho correo.</li>
        <li>Hemos dedicado un espacio para usted, el área de cliente. Desde ahi podrá consultar sus datos, los servicios contratados y podra almacenar y descargar algunos archivos importantes como el contrato o las facturas.</li>
        <li>Nos hemos tomado la libertad de iniciar sesión para usted. Le rogamos visite nuestra <a href="'._ROOT_PATH_.'area-clientes">área de clientes</a> y cambie su contraseña.</li>
        <li>Las contraseñas se generan automaticamente y se envían al correo del usuario. Esta contraseña puede mantenerla pero recomendamos que la modifique para mayor seguridad.</li>
        <li>Si tiene alguna duda no dude en contactar con nosotros. Si lo desea, puede usar el <a href="'._ROOT_PATH_.'contacto">formulario de contacto.</a></li>
    </ul>
</blockquote>';
$content.= Tools::separator();

$tpl = new Template($f_scripts);
$tpl->setContentPage('tpl.php',array(
	'[TITLE]' => Tools::getLocale()->getString('SUCCESSCART_TITLE'),
	'[SUBTITLE]' => Tools::getLocale()->getString('SUCCESSCART_SUBTITLE'),
	'[PREVIEW]' => $preview,
	'[CONTENT]' => $content,
	'[FOOTER]' => '<div class="text-center"><a class="btn" href="'._ROOT_PATH_.'area-clientes">'.Tools::getLocale()->getString('SUCCESSCART_FOOTER').'</a></div>'
	)
);

print Tools::htmlEntityDecode($tpl->getHeader());
print Tools::htmlEntityDecode($tpl->getContentPage());
print Tools::htmlEntityDecode($tpl->getFooter());
Tools::closeDB();
?>