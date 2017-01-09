<?php
require_once('../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$category = 'contacta con nosotros';
$f_scripts = "<script>fillCaptionText(['".Tools::getLocale()->getString('INDEX_BREADCRUMP')."','".Tools::getLocale()->getString('CONTACT_BREADCRUMP')."']); changeCaptionImg('"._IMAGE_PATH_."caption/bg7.jpg');actUserBar();</script>";

$preview = Tools::separator();
$content = '
<div class="max-600 div-center">
'.(
	($_REQUEST['s']) ? '<div class="alert alert-'.$_REQUEST['type'].' alert-dismissable top10">	
  	<button type="button" class="close" data-dismiss="alert">&times;</button>
  '.$_REQUEST['s'].'
  </div>' : ''
).'
<form id="formContact" class="form-horizontal" role="form" method="post" action="'._ROOT_PATH_.'contacta">
  '.((Client::isLogged()) ? '
  <div class="form-group text-center">
	<div class="btn btn-sm" id="fillFormContact">
		<span class="glyphicon glyphicon-paste top1"></span>
		'.Tools::getLocale()->getString('FORMCART_BTN_FILLBYUSER').'
	</div>
  </div>' : '' ).'
  <div class="form-group">
    <label class="sr-only" for="email_contact">'.Tools::getLocale()->getString('email').'</label>
    <input type="email" class="form-control" id="email_contact" name="email_contact" placeholder="'.Tools::getLocale()->getString('plh_email').' *" required>
  </div>
  
  <div class="form-group">
    <label class="sr-only" for="">'.Tools::getLocale()->getString('name').'</label>
    <input type="text" class="form-control" id="name_contact" name="name_contact" placeholder="'.Tools::getLocale()->getString('plh_name').' *" required>
  </div>
  
  <div class="form-group">
    <label class="sr-only" for="phone_contact">'.Tools::getLocale()->getString('phone').'</label>
    <input type="text" class="form-control" id="phone_contact" name="phone_contact" placeholder="'.Tools::getLocale()->getString('plh_phone').' *" required>
  </div>
  
  <div class="form-group">
    <label class="sr-only" for="address_contact">'.Tools::getLocale()->getString('address').'</label>
    <input type="text" class="form-control" id="address_contact" name="address_contact" placeholder="'.Tools::getLocale()->getString('plh_address').' *" required>
  </div>
  
  <!--// <div class="form-group">
    <label class="sr-only" for="address_contact">'.Tools::getLocale()->getString('service').'</label>
    <input type="text" class="form-control" id="service_contact" name="service_contact" placeholder="'.Tools::getLocale()->getString('plh_service').' *" required>
  </div> //-->
  
  <div class="form-group">
	<select multiple id="service_contact" name="service_contact[]" class="form-control" style="height:180px;">
		<optgroup label="'.Tools::getLocale()->getString('services').'">
	';
	foreach(Service::getAllServices() as $service){
		$_serv = new Service($service['id_service']);
		$_cat = new Category($_serv->getCategory());
		$content.= '	<option value="'.$service['description'].'">'.ucwords($service['description']).' ('.$_cat->getDescript().')</option>';
	}
	$content.= '
		</optgroup>
		<optgroup label="'.Tools::getLocale()->getString('others').'">
			<option value="invoices">'.Tools::getLocale()->getString('invoices').'</option>
			<option value="calls">'.Tools::getLocale()->getString('calls').'</option>
			<option value="pass">'.Tools::getLocale()->getString('pass').'</option>
			<option value="otro">'.Tools::getLocale()->getString('other').'...</option>
		</optgroup>
	</select>
  </div>
  
  <textarea class="form-control width-100" id="coment_contact" name="coment_contact" rows="4" placeholder="'.Tools::getLocale()->getString('coment').' *"></textarea>
  
  <button type="reset" class="btn btn-default width-50 top5 left">'.Tools::getLocale()->getString('reset').'</button>
  
  <button type="submit" class="btn btn-default width-50 top5" id="submit_contact" name="submit_contact" value="true">'.Tools::getLocale()->getString('send').'</button>
</form>
</div>';

$content.= Tools::separator();

$tpl = new Template($f_scripts);
$tpl->setContentPage('tpl.php',array(
	'[TITLE]' => Tools::getLocale()->getString('CONTACT_TITLE'),
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