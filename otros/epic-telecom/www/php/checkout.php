<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');
require_once(_CLASS_PATH_.'PDIGen.php');
//ini_set('display_errors',1);
//header('Content-type: text/plain charset=utf-8');
/**
 * Contratamos el servicio en este script.
 * verificaremos todo el contenido y rellenaremos el pdf correspondiente,
 * rellenaremos la base de datos y enviaremos un email de confirmación
 *
 * Obtenemos el carrito
 */
$cart = Tools::getCart();
/**
 * Combrobamos que el carrito no esta vacío e inicializamos todas las clases
 * con sus valores para obtener todos los datos.
 *
 * si el carrito esta vacío no haremos nada y redirigiremos al carrito
 */
if(!$cart->isEmpty() and Client::isLogged()){
	$cl = new Client($_SESSION['user_session']);
	// leemos el carrito y creamos las variables.
	include_once(_PHP_PATH_.'header_cart.php');
	
	// limpiamos los datos del formulario de espacios en blanco y caracteres especiales({,},?,...)
	$form = Tools::cleanArrIlegalChars($_REQUEST);
	if($_REQUEST['btn']){
			$_SESSION['form'] = $form;
	}else{
		if(Tools::isEmpty($_SESSION['form'])){
			$_SESSION['form'] = $form;
		}else{
			$form = $_SESSION['form'];
		}
	}
	// comprobamos que todos los nif/cif/nie sean correctos
	if((Tools::checkIdent($form['form_ncif']) < 1) or (Tools::checkIdent($form['form_nifrepre']) < 1) or (Tools::checkIdent($form['form_technif']) < 1)){
		header('Location: '._ROOT_PATH_.'checkout-invalid/nif-invalid');
		exit;
	}
	// comprobamos que el iban es correcto
	if((Tools::checkIBAN($form['form_accountiban'].$form['form_accountnumber']) < 1)){
		header('Location: '._ROOT_PATH_.'checkout-invalid/ccc-invalid');
		exit;
	}
	// comprobamos que el swift es correcto
	if((Tools::checkSwift($form['form_accountswift']) < 1)){
		header('Location: '._ROOT_PATH_.'checkout-invalid/swift-invalid');
		exit;
	}
	// comprobamos que los numeros de portabilidad sean correctos y que no haya mas de 10
	if(!Tools::isEmpty($form['form_gnumport_values'])){
		// convertimos en array y filtramos
		$nums = array_filter(array_unique(explode(',',$form['form_gnumport_values'])));
		if(count($nums) > 10){
			header('Location: '._ROOT_PATH_.'checkout-invalid/gnumportmax-invalid');
			exit;
		}
		foreach($nums as $num){
			$tmp_num = str_replace(array(' ','-',',','.','/'), '', $num);
			if(strlen($tmp_num) != 9){
				header('Location: '._ROOT_PATH_.'checkout-invalid/gnumport-invalid');
				exit;
			}
		}
	}
	//file_put_contents('form.txt',json_encode($form));		// probar el formulario
	// obtenemos el ultimo id de contratación para generar el nombre del pdf
	$name_pdf = CONTRATO.'_'.Tools::zerofill(Service::getLastContractID()).'.pdf';
	// creamos el PDF usando la libreria FPDF y FPDI
	$x = 64;
	$y = 51.8;
	
	$pdf = new PDIGen(_PHP_PATH_.'pdf/formulario_base.pdf');
	$pdf->lugar = 'Reus';
	$pdf->addPage1();
		$pdf->setFontSize(FONTDEFAULT-4);
		$pdf->setText(19,40,'Contrato a espera de validación por nuestros técnicos','');
		$pdf->setFontSize(FONTDEFAULT-2);
		// Dtos del titular
		// columna 1
		$pdf->setText($x, $y, $form['form_razon']);					// Razon social
		$pdf->setText($x, $y + 6, $form['form_ncif']);				// NIF/CIF
		$pdf->setText($x, $y + 12, $form['form_firstpob']);			// Población
		$pdf->setText($x, $y + 19, $form['form_firstdir']);			// direccion de facturacion
		$pdf->setText($x, $y + 26, $form['form_firstdirinst']);		// direccion de instalacion
		
		// columna 2
		$pdf->setText($x + 83.5, $y + 6, $form['form_firstcp']);		// CP
		$pdf->setText($x + 83.5, $y + 12, $form['form_firstprov']);		// Provincia
		
		// columna 1, form 2
		$pdf->setText($x, $y + 38.7, $form['form_namerepre']);			// Representante
		$pdf->setText($x, $y + 44.7, $form['form_employment']);			// Cargo del representante
		$pdf->setText($x, $y + 50.7, $form['form_phonerepre']);			// Telefono
		
		// columna 2, form 2
		$pdf->setText($x + 83.5, $y + 44.7, $form['form_nifrepre']);	// NIF
		$pdf->setCell($x + 83.5, $y + 48.5, 60, 6, $form['form_mailrepre']);	// Email
		
		// columna 1, form 3
		$pdf->setText($x, $y + 62.7, $form['form_techname']);			// tecnico
		$pdf->setText($x, $y + 69.2, $form['form_techphone']);			// telefono
		
		// columna 2, form 3
		$pdf->setText($x + 83.5, $y + 63, $form['form_technif']);		// NIF
		$pdf->setCell($x + 83.5, $y + 66.7, 60, 6, $form['form_techmail']);		// Email
		$pdf->setText($x + 83.5, $y + 75, $form['form_ip']);			// IP o Host
		
		// Dtos bancarios
		$y += 1;
		// Columna 1
		$pdf->setText($x, $y + 95, $form['form_accountowner']);		// TitulaR DE LA CUENTA DEL BANCO
		$pdf->setText($x, $y + 101, $form['form_accountncif']);		// NIF/CIF
		$pdf->setText($x, $y + 107, $form['form_accountpob']);		// Población
		$pdf->setText($x, $y + 113, $form['form_accountnumber']);	// Cuenta Cliente
		$pdf->setText($x, $y + 119, $form['form_accountiban']);		// IBAN
		
		// columna 2
		$pdf->setText($x + 83.5, $y + 101, $form['form_accountcp']);		// CP
		$pdf->setText($x + 83.5, $y + 107, $form['form_accountprov']);		// Provincia
		$pdf->setText($x + 83.5, $y + 119, $form['form_accountswift']);		// SWIFT
		
		// Fechas
		// Columna 1
		$pdf->printDate($x+1, $y + 179.4);
	// añadimos la segunda página dependiendo del servicio escogido
	$pdf->addPage2(_PHP_PATH_.'pdf/'.$cat->getPdfUrl());
	include(_PHP_PATH_.'checkphp/'.str_replace('pdf','php',$cat->getPdfUrl()));
	
	// imprimimos el resto de paginas	
	$pdf->addLastPages($x,$y);
	
	// si podemos insertar el registro mostramos el pdf
	if($cl->addService($serv)){
	// una vez finalizada la compra vaciamos el carrito y la sesion del formulario
		// imprimimos el pdf en la carpeta del usuario
		$pdf->Output(_USER_PATH_.$cl->getNif().'/files/'.$name_pdf, SAVETOURL);
		
		$mail = new Mail();
		$mail->setTo(array($cl->getEmail(), $cl->getFullName()), true);
		$mail->setBody('Copia contrato',Tools::getMailBodyContrato($cl->getFullName()));
		$mail->addAttachment(_USER_PATH_.$cl->getNif().'/files/'.$name_pdf);
		$mail->send();
		
		$cart->unset_cart();
		unset($_SESSION['form']);
		header('Location: checkout-success');
	}else{
		header('Location: checkout-invalid/'.urlencode($cl->getMessageError()));
	}
} else {
	header('Location: '._ROOT_PATH_.'cesta');
}
?>