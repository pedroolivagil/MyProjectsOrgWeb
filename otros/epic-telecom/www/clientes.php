<?php
require_once('../config.php');
require_once(_CLASS_PATH_.'Loads.php');

/* rellenamos la plantilla */
$category = 'nuestros clientes';
$f_scripts = "<script>fillCaptionText(['".Tools::getLocale()->getString('INDEX_BREADCRUMP')."','".Tools::getLocale()->getString('CLIENT_BREADCRUMP')."']); changeCaptionImg('"._IMAGE_PATH_."caption/bg6.jpg');actUserBar();</script>";

$file = file_get_contents(_DOCS_PATH_.'clientes.csv',FILE_SKIP_EMPTY_LINES);
$file = array_filter(explode("\n",utf8_encode(strtolower($file))));
$content = '';
sort($file);
$x = 0;
foreach($file as $client){
	$clientes = explode(";",$client);
	if(!Tools::isEmpty($clientes[2]) and $x < 36){
		$img = _IMAGE_PATH_.'business/'.$clientes[2];
		$content.= '<div class="busines-cell bg-white"><img src="'.$img.'" /></div>';
		$x++;
	}
}
//print_r($clientes);
$preview = Tools::separator();
$content.= Tools::separator();

/**
 * montamos la pagina segun la plantilla 
 * 
 * [TITLE], [su..], .... se reemplazan por el contenido segun el valor del idioma y de la clave
 */
$tpl = new Template($f_scripts);
$tpl->setContentPage('tpl.php',array(
	'[TITLE]' => Tools::getLocale()->getString('CLIENT_TITLE'),
	'[SUBTITLE]' => Tools::getLocale()->getString('CLIENT_SUBTITLE'),
	'[PREVIEW]' => $preview,
	'[CONTENT]' => $content,
	'[FOOTER]' => Tools::getLocale()->getString('CLIENT_FOOTER')
	)
);

print Tools::htmlEntityDecode($tpl->getHeader());
print Tools::htmlEntityDecode($tpl->getContentPage());
print Tools::htmlEntityDecode($tpl->getFooter());
Tools::closeDB();
?>