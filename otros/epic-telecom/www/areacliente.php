<?php
require_once('../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$url = (!Tools::isEmpty($_REQUEST['url']))? '/'.$_REQUEST['url'] : false;
$s = $_REQUEST['msg'];
$t = $_REQUEST['type'];

$category = 'área de clientes';
$panel = (Tools::isEmpty($_REQUEST['panel'])? 'perfil' : $_REQUEST['panel']);
$f_scripts = "<script>fillCaptionText(['".Tools::getLocale()->getString('INDEX_BREADCRUMP')."','".Tools::getLocale()->getString('CLIENTAREA_BREADCRUMP')."','".$panel."']); changeCaptionImg('"._IMAGE_PATH_."caption/bg8.jpg'); actUserBar();</script>";
//[,]
// creamos la plantilla
$tpl = new Template($f_scripts, false, true);

if(!Client::isLogged()){
	/** si NO HAY sesion iniciada, cargamos los formularios de login y re registro **/
	$title = Tools::getLocale()->getString('CLIENTAREA_TITLE_NO_LOGGED');
	$subtitle = Tools::getLocale()->getString('CLIENTAREA_SUBTITLE_NO_LOGGED');
	$preview = Tools::separator();
	$content = '
<!-- form de login -->
'.(
	($_REQUEST['url']) ? '<div class="alert alert-danger alert-dismissable top10">	
  	<button type="button" class="close" data-dismiss="alert">&times;</button>
  '.Tools::getLocale()->getString('NEED_USER_LOGIN').'
  </div>' : ''
).'
<div class="width-100 max-450 inline-block div-center padbtm40">
	<p class="center border-bottom-p"><span class="border-bottom-span">'.Tools::getLocale()->getString('login').'</span></p>
    <form class="form-horizontal" role="form" action="'._ROOT_PATH_.'sign-in'.$url.'" method="post">
        <div class="form-group">
            <input type="text" class="form-control" id="nif_login_page" name="nif_login_page" placeholder="'.Tools::getLocale()->getString('plh_nif').'" required>
        </div>
        <div class="form-group">
		  <div class="input-group">
				<input type="password" class="form-control" id="pass_login_page" name="pass_login_page" placeholder="'.Tools::getLocale()->getString('plh_pass').'" required>
			  <span class="input-group-addon"><a href="recover-password">'.Tools::getLocale()->getString('CLIENTAREA_FORGOT_PASS').'</a></span>
			</div>
        </div>
        <button type="submit" class="btn btn-default width-100">'.Tools::getLocale()->getString('login').'</button>
    </form>
	'.(
	($_REQUEST['s']) ? '<div class="alert alert-'.$_REQUEST['type'].' alert-dismissable top10">	
  	<button type="button" class="close" data-dismiss="alert">&times;</button>
  '.$_REQUEST['s'].'
  </div>' : ''
).'
</div>

<!-- form de registro -->
<div class="width-100 max-450 inline-block div-center right">
	<p class="center border-bottom-p"><span class="border-bottom-span">'.Tools::getLocale()->getString('new_client').'</span></p>
    <form class="form-horizontal" role="form" action="'._ROOT_PATH_.'sign-up'.$url.'" method="post">
        <div class="form-group">
            <label class="sr-only" for="nif_signup">'.Tools::getLocale()->getString('nif').'</label>
            <input type="text" class="form-control" maxlength="10" id="nif_signup" name="nif_signup" placeholder="'.Tools::getLocale()->getString('plh_nif').' *" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="business_signup">'.Tools::getLocale()->getString('business').'</label>
            <input type="text" class="form-control" id="business_signup" name="business_signup" maxlength="120" placeholder="'.Tools::getLocale()->getString('plh_business').' *" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="email_signup">'.Tools::getLocale()->getString('email').'</label>
            <input type="email" class="form-control" id="email_signup" name="email_signup" maxlength="120" placeholder="'.Tools::getLocale()->getString('plh_email').' *" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="fullname_signup">'.Tools::getLocale()->getString('name').'</label>
            <input type="text" class="form-control" id="fullname_signup" name="fullname_signup" maxlength="50" placeholder="'.Tools::getLocale()->getString('plh_name').' *" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="phone_signup">'.Tools::getLocale()->getString('phone').'</label>
            <input type="text" class="form-control" id="phone_signup" name="phone_signup" maxlength="10" placeholder="'.Tools::getLocale()->getString('plh_phone').'">
        </div>
		<div class="checkbox">
		  <label>
			<input type="checkbox" name="terminos" value="true">
			Acepto los <a onClick="showconditions(\'#parent-container\');">Términos y condiciones</a>.
		  </label>
		</div>
		<br />
        <button type="reset" class="btn btn-default width-50 top5 left">'.Tools::getLocale()->getString('reset').'</button>
        <button type="submit" class="btn btn-default width-50 top5">'.Tools::getLocale()->getString('new_client').'</button>
    </form>
	'.(
	($_REQUEST['msg']) ? '<div class="alert alert-'.$_REQUEST['type'].' alert-dismissable top10">	
  	<button type="button" class="close" data-dismiss="alert">&times;</button>
  '.$_REQUEST['msg'].'
  </div>' : ''
).'<br />
</div>';
	$content.= Tools::separator();
	$footer = Tools::getLocale()->getString('CLIENTAREA_FOOTER_NO_LOGGED');
}else{
	/** SI HAY session iniciada, cargamos el panel de usuario **/
	$c = new Client($_SESSION['user_session']);
	$meses = Tools::getLocale()->getString('MONTH');
	$title = Tools::getLocale()->getString('CLIENTAREA_TITLE_LOGGED');
	$subtitle = Tools::getLocale()->getString('CLIENTAREA_SUBTITLE_LOGGED');
	$preview = Tools::separator();
	$_service = new Service();
	$_cat = new Category();
	
	if(!Tools::isEmpty($s)){
		$content.= '<div class="alert alert-'.base64_decode(urldecode($t)).' alert-dismissable top10">
				<button type="button" class="close" data-dismiss="alert">&times;</button>';
				$content.= ucfirst(base64_decode(urldecode($s)));
		$content.= '</div>';
	}
	$content.='
	<div class="width-100">
		<ul class="nav nav-tabs nav-justified">
			<li '.(($panel == 'perfil')? 'class="active"':'').'><a href="'._ROOT_PATH_.'perfil">'.Tools::getLocale()->getString('profile').'</a></li>
			<li '.(($panel == 'servicios')? 'class="active"':'').'><a href="'._ROOT_PATH_.'servicios">'.Tools::getLocale()->getString('services').'</a></li>
			<li '.(($panel == 'facturas')? 'class="active"':'').'><a href="'._ROOT_PATH_.'facturas">'.Tools::getLocale()->getString('invoices').'</a></li>
		</ul>
	</div>
	';	
	if($panel=='perfil' or Tools::isEmpty($_REQUEST['panel'])){
		switch(Tools::checkIdent($c->getNif())){
			case 1:
				$iden = 'NIF';
			break;
			case 2:
				$iden = 'CIF';
			break;
			case 3:
				$iden = 'NIE';
			break;
			default:
				$iden = 'NIF';
			break;
		}
		$content.= '<div class="width-100 bg-white padall10 borderLRB">';
		$content.= '
<h2>'.Tools::getLocale()->getString('CLIENTAREA_TITULAR').'</h2><br>
<div class="row">
  <div class="col-md-3 margin10TB">
	  <div class="input-group">
		  <!--//<span class="input-group-addon">'.$iden.'</span>//-->
		  <span class="input-group-addon glyphicon glyphicon-barcode top0"></span>
		  <input type="text" class="form-control text-right center767" readonly value="'.$c->getNif().'">
	  </div>
  </div>
  <div class="col-md-3 margin10TB">
	  <div class="input-group">
		  <span class="input-group-addon">SL</span>
		  <input type="text" class="form-control center767" readonly value="'.$c->getUserName().'">
	  </div>
  </div>
  <div class="col-md-3 margin10TB">
	  <div class="input-group">
		  <span class="input-group-addon glyphicon glyphicon-envelope top0"></span>
		  <input type="text" class="form-control center767" readonly value="'.$c->getEmail().'">
	  </div>
  </div>
  <div class="col-md-3 margin10TB">
	  <div class="input-group">
		  <span class="input-group-addon glyphicon glyphicon-earphone top0"></span>
		  <input type="text" class="form-control text-right center767" readonly value="'.Tools::phonef($c->getPhone()).'">
	  </div>
  </div>
</div>';
		$content.= '
<div class="row top30">
  <div class="col-md-3 margin10TB">
	  <div class="input-group">
		  <span class="input-group-addon">ID</span>
		  <input type="text" class="form-control text-right center767" readonly value="'.$c->getID().'">
	  </div>
  </div>
  <div class="col-md-3 margin10TB">
	  <div class="input-group">
		  <span class="input-group-addon glyphicon glyphicon-eye-close top0"></span>
		  <input type="text" class="form-control center767" readonly value="#############">
	  </div>
  </div>
  <div class="col-md-3 margin10TB">
	  <div class="input-group">
		  <span class="input-group-addon glyphicon glyphicon-tag top0"></span>
		  <input type="text" class="form-control center767" readonly value="'.$c->getFullName().'">
	  </div>
  </div>
  <div class="col-md-3 margin10TB">
	  <div class="input-group">
		  <!--//<span class="input-group-addon">'.ucwords(Tools::getLocale()->getString('startup')).'</span>//-->
		  <span class="input-group-addon glyphicon glyphicon-calendar top0"></span>
		  <input type="text" class="form-control text-right center767" readonly value="'.date("d / m / Y", strtotime($c->getDataSignUp())).'">
	  </div>
  </div>
</div>
'.Tools::separator().'
<h2>'.Tools::getLocale()->getString('CLIENTAREA_EDIT_TITULAR').'</h2>
<div class="row margin5">
	<div class="btn-group" id="btn-cart">
		<button type="button" class="btn" onClick="editforms(\'pass\')">
			<span class="glyphicon glyphicon-eye-close top1 fnt-120"></span>
			&nbsp;&nbsp;'.Tools::getLocale()->getString('CLIENTAREA_EDIT_PASS').'
		</button>
	</div>
</div>
<div class="row margin5">
	<div class="btn-group" id="btn-cart">
		<button type="button" class="btn" onClick="editforms(\'email\')">
			<span class="glyphicon glyphicon-envelope top1 fnt-120"></span>
			&nbsp;&nbsp;'.Tools::getLocale()->getString('CLIENTAREA_EDIT_EMAIL').'
		</button>
	</div>
</div>
<div class="row margin5">
	<div class="btn-group" id="btn-cart">
		<button type="button" class="btn" onClick="editforms(\'name\')">
			<span class="glyphicon glyphicon-tag top1 fnt-120"></span>
			&nbsp;&nbsp;'.Tools::getLocale()->getString('CLIENTAREA_EDIT_NAME').'
		</button>
	</div>
</div>
<div class="row margin5">
	<div class="btn-group" id="btn-cart">
		<button type="button" class="btn" onClick="editforms(\'phone\')">
			<span class="glyphicon glyphicon-earphone top1 fnt-120"></span>
			&nbsp;&nbsp;'.Tools::getLocale()->getString('CLIENTAREA_EDIT_PHONE').'
		</button>
	</div>
</div>';
		$content.= '</div>';
################################################################
################################################################
	}elseif($panel=='servicios'){
		$services = $c->getServices();
		if($services){
			$content.= '

<div class="width-100 bg-white padall10 borderLRB">
<div class="well width-100 fnt-90 row-none" id="row0">
	<p class="text-center margin0 gray">'.Tools::getLocale()->getString('CLIENTAREA_SELECT').'</p>
</div>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>'.ucwords(Tools::getLocale()->getString('service')).'</th>
					<th class="text-center">'.ucwords(Tools::getLocale()->getString('category')).'</th>
					<th class="text-right">'.ucwords(Tools::getLocale()->getString('import')).'</th>
					<!--//<th class="text-center">'.ucwords(Tools::getLocale()->getString('permanency')).'</th>//-->
					<!--//<th class="text-center">'.ucwords(Tools::getLocale()->getString('startup')).'</th>//-->
					<th class="text-center">'.ucwords(Tools::getLocale()->getString('date_request')).'</th>
				</tr>
			</thead>
			<tbody>';
			foreach($services as $serv_select){
				if($serv_select['visible']){
					$_service->select($serv_select['id_service']);
					$_cat->select($_service->getCategory());
					$content.= '<tr onClick="openrow(\''.$serv_select['id_contratacion'].'\')">
						<td>'.ucwords($serv_select['description']).'</td>
						<td class="text-center">'.$_cat->getDescript().'</td>
						<td class="text-right">'.Tools::num_format($serv_select['mensual_fee'],2).'€</td>
						<!--//<td class="text-center">'.$serv_select['permanency'].' <small>meses</small></td>//-->
						<!--//<td class="text-center">'.Tools::num_format($serv_select['entry_fee'],2).'€</td>//-->
						<td class="text-center">'.$meses[date("m",strtotime($serv_select['date_request']))-1].' - '.date("Y",strtotime($serv_select['date_request'])).'</td>
					</tr>';
				}
			}
			$content.= '</tbody></table></div></div>';
		}else{
			$content.='<div class="width-100 minh150 lineh150 bg-white padall10 borderLRB text-center gray">'.ucfirst(Tools::getLocale()->getString('CLIENTAREA_NO_SERVICES')).'</div>';
		}
################################################################
################################################################
	}elseif($panel=='facturas'){
		/* Creamos la lista de facturas mediante una consulta multitabla */
		$invoices = $c->getInvoices();
		if($invoices){
			// creamos una tabla de bootstrap
			$content.= '<div class="width-100 bg-white padall10 borderLRB">
	<div class="table-responsive">
		<table class="table table-hover table-condensed table-responsive">
			<thead>
				<tr>
					<th>#</th>
					<th>'.ucwords(Tools::getLocale()->getString('service')).'</th>
					<th>'.ucwords(Tools::getLocale()->getString('emision')).'</th>
					<th class="text-right">'.ucwords(Tools::getLocale()->getString('import')).'</th>
					<th class="text-right">'.ucwords(Tools::getLocale()->getString('state')).'</th>
					<th class="center">'.ucwords(Tools::getLocale()->getString('download')).'</th>
				</tr>
			</thead>
			<tbody>';
			foreach($invoices as $invoice){
				if($invoice['status']==1){
					$tr = '';
				}else if($invoice['status']==2){
					$tr = 'warning';
				}else if($invoice['status']==3){
					$tr = 'danger';
				}
				$content.= '<tr class="'.$tr.'">
					<td>'.$invoice['id_invoice'].'</td>
					<td>'.ucwords($invoice['description']).'</td>
					<td>'.$meses[date("m",strtotime($invoice['date']))-1].' - '.date("Y",strtotime($invoice['date'])).'</td>
					<td class="text-right">'.Tools::num_format($invoice['mensual_fee'],2).'€</td>
					<td class="text-right">'.$invoice['descript'].'</td>
					<td class="center"><a href="'.$invoice['invoice_url'].'"><span class="glyphicon glyphicon-download-alt"></span></a></td>
				</tr>';
			}
			$content.= '</tbody></table></div></div>';
		}else{
			$content.='<div class="width-100 minh150 lineh150 bg-white padall10 borderLRB text-center gray">'.ucfirst(Tools::getLocale()->getString('CLIENTAREA_NO_INVOICES')).'</div>';
		}
	}
	
	$content.= Tools::separator();
	$last = $c->lastAccess();
	//$last = date('jS \o\f F \o\f Y \a\t H:i:s',strtotime($last['timedate']));
	//$last = date(DATE_RFC2822,strtotime($last['timedate']));
	$last = $meses[date("m",strtotime($last['timedate']))-1].date(" j, Y, g:i a",strtotime($last['timedate']));
	$footer = Tools::getLocale()->getString('CLIENTAREA_FOOTER_LOGGED').' <span class="gray">'.$last.'</span>';
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