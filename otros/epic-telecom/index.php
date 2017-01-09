<?php
require_once('config.php');
require_once(_CLASS_PATH_.'Loads.php');

$f_scripts = "<script>fillCaptionText(['".Tools::getLocale()->getString('INDEX_BREADCRUMP')."']);actUserBar();</script>";

$sql = Tools::getDB()->query('SELECT COUNT(*), services FROM client_purchase GROUP BY 2 ORDER BY 1 DESC LIMIT 6');

$preview = Tools::separator();
if($res = $sql->fetch_row()){
	$preview.= '<div class="row center"><h3 class="text-center">'.Tools::getLocale()->getString('INDEX_BESTSELLERS').'</h3>';
	do{
		$serv = new Service($res[1]);
		$cat = new Category($serv->getCategory());
		$preview.= '
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
			  <img src="'._IMAGE_PATH_.'caption/bg'.rand(1,7).'.jpg" class="width-100">
			  <div class="caption">
				<h3>'.ucwords($serv->getDescript()).'</h3>
				<!--// <p>'.Tools::cutOutput(Tools::getLocale()->getString('VOICE_TITLE'),80).'</p> //-->
				<p>
				  <a href="'._ROOT_PATH_.$cat->getLink().'" class="btn btn-primary" role="button">'.Tools::getLocale()->getString('VIEW_MORE').'</a>
				</p>
			  </div>
			</div>
		</div>';
	}while($res = $sql->fetch_row());
	$preview.= '</div>';
	$preview.= Tools::separator();
}
$content= '<div class="row center"><h3 class="text-center">'.Tools::getLocale()->getString('INDEX_OWN').'</h3>';
$content.= '<div class="row center">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="'._IMAGE_PATH_.'caption/bg4.jpg" class="width-100">
      <div class="caption">
        <h3>'.Tools::getLocale()->getString('NAV_LINE_VOICE').'</h3>
        <p>'.Tools::cutOutput(Tools::getLocale()->getString('VOICE_TITLE'),80).'</p>
        <p>
          <a href="'._ROOT_PATH_.'lineas-de-voz" class="btn btn-primary" role="button">'.Tools::getLocale()->getString('VIEW_MORE').'</a>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="'._IMAGE_PATH_.'caption/bg5.jpg" class="width-100">
      <div class="caption">
        <h3>'.Tools::getLocale()->getString('NAV_INTERNET').'</h3>
        <p>'.Tools::cutOutput(Tools::getLocale()->getString('AIRE_TITLE'),80).'</p>
        <p>
          <a href="'._ROOT_PATH_.'internet-aire" class="btn btn-primary" role="button">'.Tools::getLocale()->getString('VIEW_MORE').'</a>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="'._IMAGE_PATH_.'caption/bg6.jpg" class="width-100">
      <div class="caption">
        <h3>'.Tools::getLocale()->getString('NAV_CLIENTS').'</h3>
        <p>'.Tools::cutOutput(Tools::getLocale()->getString('CLIENT_TITLE'),80).'</p>
        <p>
          <a href="'._ROOT_PATH_.'clientes" class="btn btn-primary" role="button">'.Tools::getLocale()->getString('VIEW_MORE').'</a>
        </p>
      </div>
    </div>
  </div>
</div>
<!-- Fila 2 -->
<div class="row center">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="'._IMAGE_PATH_.'caption/bg8.jpg" class="width-100">
      <div class="caption">
        <h3>'.Tools::getLocale()->getString('NAV_CLIENT_AREA').'</h3>
        <p>'.Tools::cutOutput(Tools::getLocale()->getString('CLIENTAREA_TITLE_NO_LOGGED').'. '.Tools::getLocale()->getString('CLIENTAREA_FOOTER_NO_LOGGED'),80).'.</p>
        <p>
          <a href="'._ROOT_PATH_.'area-clientes" class="btn btn-primary" role="button">'.Tools::getLocale()->getString('VIEW_MORE').'</a>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="'._IMAGE_PATH_.'caption/bg7.jpg" class="width-100">
      <div class="caption">
        <h3>'.Tools::getLocale()->getString('NAV_CONTACT').'</h3>
        <p>'.Tools::cutOutput(Tools::getLocale()->getString('CONTACT_SUBTITLE'),80).'</p>
        <p>
          <a href="'._ROOT_PATH_.'contacto" class="btn btn-primary" role="button">'.Tools::getLocale()->getString('VIEW_MORE').'</a>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3004.6285404306823!2d1.126052615567981!3d41.14263431909461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a150cea08c4dff%3A0xebe717c51033d18!2sAvinguda+Bellissens%2C+42%2C+43204+Reus%2C+Tarragona!5e0!3m2!1ses!2ses!4v1453166625178" width="100%" height="205" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div>
</div>';

$tpl = new Template($f_scripts, true);
$tpl->setContentPage('tpl.php',array(
	'[TITLE]' => Tools::getLocale()->getString('INDEX_TITLE'),
	'[SUBTITLE]' => Tools::getLocale()->getString('INDEX_SUBTITLE'),
	'[PREVIEW]' => $preview,
	'[CONTENT]' => $content,
	'[FOOTER]' => Tools::getLocale()->getString('INDEX_FOOTER')
	)
);
echo Tools::htmlEntityDecode($tpl->getHeader());
echo Tools::htmlEntityDecode($tpl->getContentPage());
echo Tools::htmlEntityDecode($tpl->getFooter());
?>