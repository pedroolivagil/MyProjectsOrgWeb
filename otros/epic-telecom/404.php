<?php
require_once('config.php');
require_once(_CLASS_PATH_.'Tools.php');
require_once(_CLASS_PATH_.'Template.php');
Tools::init('es');
$f_scripts = "<script>fillCaptionText(['inicio','Error 404']); changeCaptionImg('"._IMAGE_PATH_."caption/bg8.jpg');</script>";

$preview = Tools::separator();
$content = '<p class="center">Lo sentimos, la página que buscas no existe.</p><p class="center"><a class="btn" onClick="btnBack();">Volver</a></p>';
$content.= Tools::separator();

$tpl = new Template($f_scripts);
$tpl->setContentPage('tpl.php',array(
	'[TITLE]' => Tools::getLocale()->getString('404_TITLE'),
	'[SUBTITLE]' => Tools::getLocale()->getString('404_SUBTITLE'),
	'[PREVIEW]' => $preview,
	'[CONTENT]' => $content,
	'[FOOTER]' => Tools::getLocale()->getString('404_FOOTER')
	)
);

print Tools::htmlEntityDecode($tpl->getHeader());
print Tools::htmlEntityDecode($tpl->getContentPage());
print Tools::htmlEntityDecode($tpl->getFooter());
?>