<?php
require_once('../config.php');
require_once(_CLASS_PATH_.'Loads.php');

if(Client::isLogged()){
	header('Location: '._ROOT_PATH_.'area-clientes');
}

$category = 'área de clientes';
$panel = (Tools::isEmpty($_REQUEST['panel'])? 'perfil' : $_REQUEST['panel']);
$f_scripts = "<script>fillCaptionText(['".Tools::getLocale()->getString('INDEX_BREADCRUMP')."','".Tools::getLocale()->getString('CLIENTAREA_BREADCRUMP')."','".Tools::getLocale()->getString('RECOVER_BREADCRUMP')."']); changeCaptionImg('"._IMAGE_PATH_."caption/bg8.jpg');actUserBar();</script>";

// creamos la plantilla
$tpl = new Template($f_scripts);

if(!Client::isLogged()){
	/** si NO HAY sesion iniciada, cargamos los formularios de login y re registro **/
	$title = Tools::getLocale()->getString('RECOVER_TITLE');
	$subtitle = Tools::getLocale()->getString('RECOVER_SUBTITLE');
	$preview = Tools::separator();
	$content = '
<!-- form de login -->
<div class="width-100 max-450 div-center">
	<p class="center border-bottom-p"><span class="border-bottom-span">'.Tools::getLocale()->getString('recover').'</span></p>
    <form class="form-horizontal" role="form" action="'._ROOT_PATH_.'recover" method="post">
        <div class="form-group">
            <input type="text" class="form-control" id="nif_recover" name="nif_recover" placeholder="'.Tools::getLocale()->getString('plh_nif').'" required>
        </div>
        <button type="submit" class="btn btn-default width-100">'.Tools::getLocale()->getString('recover').'</button>
    </form>
	'.(
	($_REQUEST['s']) ? '<div class="alert alert-'.$_REQUEST['type'].' alert-dismissable top10">	
  	<button type="button" class="close" data-dismiss="alert">&times;</button>
  '.$_REQUEST['s'].'
  </div>' : ''
).'
</div>';
	$content.= Tools::separator();
	$footer = Tools::getLocale()->getString('RECOVER_FOOTER');
}
$tpl->setContentPage('tpl.php',array(
	'[TITLE]' => $title,
	'[SUBTITLE]' => $subtitle,
	'[PREVIEW]' => $preview,
	'[CONTENT]' => $content,
	'[FOOTER]' => $footer
	)
);

print Tools::htmlEntityDecode($tpl->getHeader());
print Tools::htmlEntityDecode($tpl->getContentPage());
print Tools::htmlEntityDecode($tpl->getFooter());
Tools::closeDB();
?>