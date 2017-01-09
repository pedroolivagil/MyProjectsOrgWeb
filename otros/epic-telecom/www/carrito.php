<?php
require_once('../config.php');
require_once(_CLASS_PATH_.'Loads.php');

if(!Client::isLogged()){
	header('Location: '._ROOT_PATH_.'first-login');
}
$f_scripts = "<script>fillCaptionText(['".Tools::getLocale()->getString('INDEX_BREADCRUMP')."','".Tools::getLocale()->getString('CART_BREADCRUMP')."']); changeCaptionImg('"._IMAGE_PATH_."caption/bg9.jpg'); checklegalisreaded(); actUserBar(true);".(($_SESSION['form'])? ' fillFormAuto();' : '')."</script>\n<style>p { margin:0 !important; }</style>";

// creamos la plantilla
$tpl = new Template($f_scripts, false, true);
$title = Tools::getLocale()->getString('CART_TITLE');
$subtitle = Tools::getLocale()->getString('CART_SUBTITLE');
$preview = Tools::separator();
$cart = Tools::getCart();
$content = '';

// si el formulario es incorrecto y se vuelve atras, rellenamos el formulario con los datos anteriores
$m = $_REQUEST['m'];
if(!Tools::isEmpty($m)){
	$content.= '<div class="alert alert-danger alert-dismissable top10">
			<button type="button" class="close" data-dismiss="alert">&times;</button>';
	if($m == 'nif-invalid'){
			$content.= Tools::getLocale()->getString('BAD_NIF');
			$ncif = true;
	}
	if($m == 'ccc-invalid'){
			$content.= Tools::getLocale()->getString('BAD_CCC');
			$ccc = true;
	}
	if($m == 'swift-invalid'){
			$content.= Tools::getLocale()->getString('BAD_SWIFT');
			$swift = true;
	}
	if($m == 'gnumportmax-invalid'){
			$content.= Tools::getLocale()->getString('BAD_GNUMPORTMAX');
			$gnumport = true;
	}
	if($m == 'gnumport-invalid'){
			$content.= Tools::getLocale()->getString('BAD_GNUMPORT');
			$gnumport = true;
	}
	if(Tools::startsWith($m,'Error: ')){
			$content.= $m;
	}
	$content.= '</div>';
}
// combrobamos que el carrito no esta vacío y lo mostramos
if(!Tools::isEmpty(Tools::getCookie(_CART_)) and !$cart->isEmpty()){
	// leemos el carrito y creamos las variables.
	include_once(_PHP_PATH_.'header_cart.php');
	
    $content.= '
	<form name="checkout_form" id="checkout_form" method="post" action="'._ROOT_PATH_.'checkout-cart">
	<div class="table-responsive">
	<table class="well table table-bordered max-700 table-cart-page element-center">
    	<tr>
            <td colspan="4" class="text-center">
                <h3>Servicio a contratar: '.ucwords($cat->getDescript()).'</h3>
            </td>
        </tr>
    	<tr>
        	<td>
				<span class="fnt-100"><strong>'.ucwords($serv->getDescript()).'</strong></span>
        	</td>
            <td width="180">
                <p class="text-right">
                    <span class="fnt-70">Coste mensual:&nbsp;&nbsp;</span>
                    <strong>'.Tools::num_format($serv->getFee(),2).'€</strong>
                </p>
                <p class="text-right">
                    <span class="fnt-70">Coste alta:&nbsp;&nbsp;</span>
                    <strong>'.Tools::num_format($serv->getFeeHigh(),2).'€</strong>
                </p>
        	</td>
			<td width="90" class="text-center">
				<a class="loader" href="del-to-cart/'.$cart->getService().'#caption-text">
					<span class="btn glyphicon glyphicon-trash top0" style="font-size: 130%; padding: 4px 10px 4px 8px;"></span>
				</a>
			</td>
			<td width="130" class="text-right">
                <p class="text-right">
                    <strong>'.Tools::num_format($serv->getFee(),2).'€</strong>
                </p>
                <p class="text-right">
                    <strong>'.Tools::num_format($serv->getFeeHigh(),2).'€</strong>
                </p>
			</td>
        </tr>';
		if(!Tools::isEmpty($servicios)){
			foreach($servicios as $key => $cant){
				$sub->select($key);	
        $content.= '<tr>
        	<td>
                <span class="fnt-100"><strong> + '.$sub->getDescript().'</strong></span>
				'.(($sub->getCodeService()=='EXTENSION')? ' (<span class="fnt-70"><strong>'.$sub->getAttr1().'</strong></span>)' : '').'
           	</td>
        	<td><p class="text-right">
                    <span class="fnt-70">Coste mensual:&nbsp;&nbsp;</span>
                    <strong>'.Tools::num_format($sub->getFee(),2).'€</strong>
                </p>
            </td>
			<td class="fnt-90">';
				if($sub->getCodeService()=='EXTENSION'){
                    $href = array('<a class="loader" href="add-sub-to-cart/'.$sub->getID().'#caption-text">','</a>');
                    $class= ' hoverup';
                }else{
                    $href = array('<a class="disabled">','</a>');
                    $class= '';
                }
                $content.= '<div class="left" style="width:20px; margin-top:-10px;">
                    <div style="margin-top:12px;">
                    '.$href[0].'
                        <span class="glyphicon glyphicon-chevron-up '.$class.'" title="Añadir"></span>
                    '.$href[1].'
                    </div>
                    <div style="margin-top:-5px;">
                    <a class="loader" href="del-sub-to-cart/'.$sub->getID().'#caption-text">
                        <span class="glyphicon glyphicon glyphicon-chevron-down hoverdown" title="Quitar"></span>
                    </a>
                    </div>
                </div>
                <div style="padding:7px; margin-left: 16px;" class="fnt-120 text-right">
                    <p class="padLR well text-center" style="color:rgba(0,0,0,.5);">
                        <strong>'.$cant.'</strong>
                    </p> 
                </div>
			</td>
			<td width="70" class="text-right">
				<strong>'.Tools::num_format($cant * $sub->getFee(),2).'€</strong>
			</td>
        </tr>';
			}
		}
        $content.= '<tr><td colspan="4" style="background:#EEE;"></td></tr>
		<tr style="height:40px;"><td colspan="2" rowspan="4" style="vertical-align:top !important;">';
		if($cat->getID() == 1){
			// si el servicio son líneas de voz
			 $content.= '<script>checkGnumPort();</script>';
		if($serv->getDescript() == 'línea digital SIP profesional'){
			$content.= '<div class="input-group">
			<span class="input-group-addon">Canales adicionales <span class="fnt-70">(Solo Línea Digital SIP Profesional)</span></span>
			<input type="number" pattern="[0-9]{3}" class="form-control text-center" maxlength="3" max="999" min="0" value="0" id="form_chnladd" name="form_chnladd">
		</div>';
		}
		
		$content.= '<div class="input-group top10">
			<span class="input-group-addon">Numeración geográfica adicional <span class="fnt-70">(+2€/u)</span></span>
			<input type="number" pattern="[0-9]{3}" class="form-control text-center" maxlength="3" max="999" min="0" value="0" id="form_gnumadd" name="form_gnumadd">
		</div>
		
		<!-- restriccion de llamadas a 80x,90x y 118xx -->
		<div class="top10">
			<div class="input-group">
				<span class="input-group-addon">
					<input type="checkbox" name="form_restrictaddicionalnums" id="form_restrictaddicionalnums" '.(($_SESSION['form']['form_restrictaddicionalnums']) ? ' checked' : '').'>
				</span>
				<label class="form-control no-bolder" for="form_restrictaddicionalnums">Restriccion de llamadas a 80x, 90x y 118xx</label>
			</div>
		</div>
		
		<!-- restriccion de llamadas internacionales -->
		<div class="top10">
			<div class="input-group">
				<span class="input-group-addon">
					<input type="checkbox" name="form_restrictinternational" id="form_restrictinternational" '.(($_SESSION['form']['form_restrictinternational']) ? ' checked' : '').'>
				</span>
				<label class="form-control no-bolder" for="form_restrictinternational">Restriccion de llamadas internacionales</label>
			</div>
		</div>
		
		<!-- autorizacion de llamadas internacionales zona a -->
		<div class="top10">
			<div class="input-group">
				<span class="input-group-addon">
					<input type="checkbox" name="form_autorizZonaA" id="form_autorizZonaA" '.(($_SESSION['form']['form_autorizZonaA']) ? ' checked' : '').'>
				</span>
				<label class="form-control no-bolder" for="form_autorizZonaA">Autorizacion de llamadas internacionales zona A</label>
			</div>
		</div>
		
		<!-- adjuntar solicitud -->
		<div class="top10">
			<div class="input-group '.(($gnumport)? 'has-error':'').'">
				<span class="input-group-addon">
					<input type="checkbox" name="form_gnumport" id="form_gnumport" '.(($_SESSION['form']['form_gnumport']) ? ' checked' : '').'>
				</span>
				<label class="form-control no-bolder" for="form_gnumport">Adjuntará solicitud de portabilidad de numeración</label>
			</div>
		</div>
		
		<div class="top10" id="div_gnumport_values">
			<div class="input-group '.(($gnumport)? 'has-error':'').'">
				<span class="input-group-addon glyphicon glyphicon-earphone top0"></span>
				<input type="text" class="form-control" id="form_gnumport_values" name="form_gnumport_values" placeholder="Números que quiera adjuntar separados por comas(,)" maxlength="500">
			</div>
		</div>
		
		<!-- autorizacion de llamadas internacionales internacionales -->
		<div class="top10">
			<div class="input-group">
				<span class="input-group-addon">
					<input type="checkbox" name="form_autorizinternational" id="form_autorizinternational" '.(($_SESSION['form']['form_autorizinternational']) ? ' checked' : '').'>
				</span>
				<label class="form-control no-bolder" for="form_autorizinternational">Autorizacion de llamadas internacionales por destino</label>
			</div>
		</div>
		
		<div class="top10" id="div_autorizinternational_values">
			<div class="input-group">
				<span class="input-group-addon glyphicon glyphicon-globe top0"></span>
				<input type="text" class="form-control" id="form_autorizinternational_values" name="form_autorizinternational_values" placeholder="Paises que desee separados por comas(,)" maxlength="500">
			</div>
		</div>
		';
		}elseif($cat->getID() == 2){
			$sub->selectByCodeService('INST_EXTENSION');
			$content.='
		<div>
			<div class="input-group">
				<span class="input-group-addon">Precio de instalación <span class="fnt-70">(incluido en el alta)</span></span>
				<span class="form-control text-right">
					'.Tools::num_format(count($cart->getSubServices()) * $sub->getEntryFee(),2).'€ 
					<span class="gray">('.count($cart->getSubServices()).' x '.Tools::num_format($sub->getEntryFee(),2).'€)</span>
				</span>
			</div>
		</div>
		
		<div class="top10">
			<div class="input-group">
				<span class="input-group-addon">Precio de extensión <span class="fnt-70">(incluido en el total)</span></span>
				<span class="form-control text-right">
					'.Tools::num_format(count($cart->getSubServices()) * $sub->getFee(),2).'€ 
					<span class="gray">('.count($cart->getSubServices()).' x '.Tools::num_format($sub->getFee(),2).'€)</span>
				</span>
			</div>
		</div>';
		}
		$content.= '</td>
        	<td>
                <p class="text-right">
                	<span class="fnt-80">Total</span>
                </p>
            </td>
        	<td>
                <p class="text-right">
					<span class="fnt-150">
						<strong>'.Tools::num_format($cart->getTotal(),2).'€</strong>
					</span>
                </p>
            </td>
        </tr>
		<tr style="height:40px;">
        	<td>
                <p class="text-right fnt-100">
                	<span class="fnt-80">Alta</span>
                </p>
            </td>
        	<td>
                <p class="text-right fnt-100">
                    <strong>'.Tools::num_format($cart->getTotalEntry(),2).'€</strong>
                </p>
            </td>
        </tr>
		<tr>
			<td colspan="2" style="background:#EEE;"></td>
		</tr>
		<tr style="height:50px;">
			<td colspan="2" class="text-center">
				<button type="button" class="btn width-100">
					<span class="glyphicon glyphicon-arrow-down top1 fnt-120"></span>
					&nbsp;&nbsp;&nbsp;Continuar&nbsp;&nbsp;&nbsp;
					<span class="glyphicon glyphicon-arrow-down top1 fnt-120"></span>
				</button>
			</td>
		</tr>
    </table>
	</div>
	<br>'.Tools::separator().'<br>
	
	<!-- formulario de registro -->
	<div class="">
	<table class="well table table-bordered max-700 table-cart-page element-center">
		<tr>
			<td colspan="2">
				<h3 class="text-center">Paso 1: Datos del titular</h3>
			</td>	
		</tr>
		<tr>
			<td colspan="2" class="text-center">
				<div class="btn btn-sm" id="fillForm">
					<span class="glyphicon glyphicon-paste top1"></span>
					'.Tools::getLocale()->getString('FORMCART_BTN_FILLBYUSER').'
				</div>
			</td>
		</tr>
    	<tr>
            <td style="vertical-align:top !important;">
  <div class="form-group">
    <input type="text" class="form-control" id="form_razon" name="form_razon" placeholder="'.Tools::getLocale()->getString('FORMCART_RAZON').' *" maxlength="60" required>
  </div>
  
  <div class="form-group '.(($ncif)? 'has-error':'').'">
    <input type="text" class="form-control" id="form_ncif" name="form_ncif" placeholder="'.Tools::getLocale()->getString('FORMCART_NCIF').' *" maxlength="10" required>
  </div>
  
  '.Tools::separator().'
  
  <div class="form-group">
    <input type="text" class="form-control" id="form_namerepre" name="form_namerepre" placeholder="'.Tools::getLocale()->getString('FORMCART_NAMEREPRE').' *" maxlength="50" required>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="form_employment" name="form_employment" placeholder="'.Tools::getLocale()->getString('FORMCART_EMPLOYMENT').' *" maxlength="50" required>
  </div>
  
  <div class="form-group '.(($ncif)? 'has-error':'').'">
    <input type="text" class="form-control" id="form_nifrepre" name="form_nifrepre" placeholder="'.Tools::getLocale()->getString('FORMCART_NIF').' *" maxlength="10" required>
  </div>
  
  <div class="form-group">
    <input type="email" class="form-control" id="form_mailrepre" name="form_mailrepre" placeholder="'.Tools::getLocale()->getString('FORMCART_MAIL').' *" maxlength="100" required>
  </div>
  
  <div class="form-group">
    <input type="tel" pattern="[6-9]{1}[0-9]{8}" class="form-control" id="form_phonerepre" name="form_phonerepre" placeholder="'.Tools::getLocale()->getString('FORMCART_PHONE').' *" maxlength="9" required>
  </div>
            </td>
            <td>
  <div class="form-group">
    <input type="text" class="form-control" id="form_techname" name="form_techname" placeholder="'.Tools::getLocale()->getString('FORMCART_TECHNAME').' *" maxlength="50" required>
  </div>
  
  <div class="form-group '.(($ncif)? 'has-error':'').'">
    <input type="text" class="form-control" id="form_technif" name="form_technif" placeholder="'.Tools::getLocale()->getString('FORMCART_NIF').' *" maxlength="10" required>
  </div>
  
  <div class="form-group">
    <input type="email" class="form-control" id="form_techmail" name="form_techmail" placeholder="'.Tools::getLocale()->getString('FORMCART_MAIL').' *" maxlength="100" required>
  </div>
  
  <div class="form-group">
    <input type="tel" pattern="[6-9]{1}[0-9]{8}" class="form-control" id="form_techphone" name="form_techphone" placeholder="'.Tools::getLocale()->getString('FORMCART_PHONE').' *" maxlength="9" required>
  </div>
  
  '.Tools::separator().'
 
  <div class="form-group">
    <input type="text" class="form-control" id="form_firstpob" name="form_firstpob" placeholder="'.Tools::getLocale()->getString('FORMCART_POB').' *" maxlength="30" required>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="form_firstprov" name="form_firstprov" placeholder="'.Tools::getLocale()->getString('FORMCART_PROV').' *" maxlength="30" required>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="form_firstcp" name="form_firstcp" placeholder="'.Tools::getLocale()->getString('FORMCART_CP').' *" maxlength="5" required>
  </div>
  			</td>
        </tr>
     	<tr>
			<td colspan="2">
  <div class="form-group">
    <input type="text" class="form-control" id="form_firstdir" name="form_firstdir" placeholder="'.Tools::getLocale()->getString('FORMCART_DIRFACT').' *" maxlength="50" required>
  </div>
  
  <div class="form-group">
  	<div class="input-group">
		<input type="text" class="form-control" id="form_firstdirinst" name="form_firstdirinst" placeholder="'.Tools::getLocale()->getString('FORMCART_DIRINST').' *" maxlength="120" required>
		<span class="input-group-addon"><a onClick="copydir()">Copiar de facturación</a></span>
	</div>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="form_ip" name="form_ip" placeholder="'.Tools::getLocale()->getString('FORMCART_IP').'" maxlength="50">
  </div>
  				<button type="button" class="btn width-100">
					<span class="glyphicon glyphicon-arrow-down top1 fnt-120"></span>
					&nbsp;&nbsp;&nbsp;Continuar&nbsp;&nbsp;&nbsp;
					<span class="glyphicon glyphicon-arrow-down top1 fnt-120"></span>
				</button>
  			</td>
        </tr>
	</table>
	</div>
	<br>'.Tools::separator().'<br>
	
	<!-- formulario de banco -->
	<div class="">
	<table class="well table table-bordered max-700 table-cart-page element-center">
		<tr>
			<td colspan="2"><h3 class="text-center">Paso 2: Datos bancarios</h3></td>	
		</tr>
    	<tr>
            <td style="vertical-align:top !important;">
  <div class="form-group">
    <input type="text" class="form-control" id="form_accountowner" name="form_accountowner" placeholder="'.Tools::getLocale()->getString('FORMCART_ACOUNTOWNER').' *" maxlength="50" required>
  </div>
  
  <div class="form-group '.(($ncif)? 'has-error':'').'">
    <input type="text" class="form-control" id="form_accountncif" name="form_accountncif" placeholder="'.Tools::getLocale()->getString('FORMCART_NCIF').' *" maxlength="10" required>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="form_accountiban" name="form_accountiban" placeholder="'.Tools::getLocale()->getString('FORMCART_ACOUNTIBAN').' *" maxlength="4" required>
  </div>
  
  <div class="form-group '.(($swift)? 'has-error':'').'">
    <input type="text" class="form-control" id="form_accountswift" name="form_accountswift" placeholder="'.Tools::getLocale()->getString('FORMCART_ACOUNTSWIFT').' *" maxlength="11" required>
  </div>
            </td>
            <td style="vertical-align:top !important;">
  <div class="form-group">
    <input type="text" class="form-control" id="form_accountprov" name="form_accountprov" placeholder="'.Tools::getLocale()->getString('FORMCART_PROV').' *" maxlength="30" required>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="form_accountpob" name="form_accountpob" placeholder="'.Tools::getLocale()->getString('FORMCART_POB').' *" maxlength="30" required>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="form_accountcp" name="form_accountcp" placeholder="'.Tools::getLocale()->getString('FORMCART_CP').' *" maxlength="5" required>
  </div>
  
  <div class="form-group '.(($ccc)? 'has-error':'').'">
    <input type="text" class="form-control" id="form_accountnumber" name="form_accountnumber" placeholder="'.Tools::getLocale()->getString('FORMCART_ACOUNTNUMBER').' *" maxlength="20" required>
  </div>
  			</td>
        </tr>
     	<tr>
			<td colspan="2">
  				<button type="button" class="btn width-100">
					<span class="glyphicon glyphicon-arrow-down top1 fnt-120"></span>
					&nbsp;&nbsp;&nbsp;Continuar&nbsp;&nbsp;&nbsp;
					<span class="glyphicon glyphicon-arrow-down top1 fnt-120"></span>
				</button>
  			</td>
        </tr>
	</table>
	</div>
	<br>'.Tools::separator().'<br>
	
	<!-- términos del formulario -->
	<div class="">
	<table class="well table table-bordered max-700 table-cart-page element-center">
		<tr>
			<td><h3 class="text-center">Paso 3: Lea los términos de Epic</h3></td>
        </tr>
		<tr>
			<td>
				<div class="aviso-legal" id="legal-div">
					<div>'.file_get_contents(_FORM_PATH_.Tools::$lang.'/'._LEGAL_FILE_).'</div>
				</div>
  			</td>
        </tr>
     	<tr>
			<td>
	<button type="submit" id="btn" name="btn" value="true" class="btn width-100" disabled title="'.Tools::getLocale()->getString('FORMCART_TITLE_READ_LEGAL').'">
		<span class="glyphicon glyphicon-ok top1 fnt-120"></span>
		&nbsp;Aceptar términos y contratar
	</button>
  			</td>
        </tr>
	</table>
	</div>
	</form>';
}else{	
	$content = '
	<table class="well table table-bordered max-700 table-cart-page element-center">
    	<tr>
            <td>
                <p class="text-center top10">Cesta vacía</p>
            </td>
        </tr>
    </table>';
}
$content.= Tools::separator();
$footer = Tools::getLocale()->getString('CART_FOOTER');

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