<?php
$pdf->setFontSize(FONTDEFAULT-4);
$pdf->setText(19,43.5,'Contrato a espera de validación por nuestros técnicos','');
$pdf->setFontSize(FONTDEFAULT);

$pdf->SetTextColor(255);
$pdf->setText(19.7,48.3, $cat->getDescript(),'B');
$pdf->SetTextColor(FONTCOLORDEF);

$x = 65;
$y = 55.5;
$pX = 59;
$pY = 51.5;

$pdf->setFontSize(FONTDEFAULT-2);
$pdf->setCell($pX, $pY, 35, 5, 'Canales de llamada', 'C');		
$pdf->setCell($pX + 35, $pY, 41, 5, 'Minutos incluidos', 'C');
$pdf->setCell($pX + 35 + 41, $pY, 13.4, 5, '', 'C' ,0);
$pdf->setCell($pX + 35 + 41 + 13.4, $pY, 23, 5, 'Cuota', 'C');
$pdf->setCell($pX + 35 + 41 + 13.4 + 23, $pY, 19, 5, 'Total', 'C');

$pY+=5.2;
$pdf->setFontSize(FONTDEFAULT-4);
$pdf->setCell($pX, $pY, 18, 5, 'Entrada', 'C');		
$pdf->setCell($pX + 18, $pY, 17, 5, 'Salida', 'C');
$pdf->setCell($pX + 35, $pY, 20, 5, 'A fijos', 'C');		
$pdf->setCell($pX + 35 + 20, $pY, 21, 5, 'A móviles', 'C');

$pY+=5.2;	
$pdf->setFontSize(FONTDEFAULT-1);
$pdf->setCell(20, $pY, 39, 5, ucwords(str_replace('profesional','PRO',$serv->getDescript())), 'L');	

foreach($serv->getSubservices() as $service){
    $pdf->setFontSize(FONTDEFAULT-1);
	$sub->select($service['id']);
	switch($sub->getCodeService()){	
		case 'CENTSOR':
			$pdf->setCell($pX, $pY, 18, 5, $sub->getAttr1(), 'C' ,'LTB');		
			$pdf->setCell($pX+18, $pY, 17, 5, $sub->getAttr2(), 'C' ,'LTB');
		break;
		case 'MF':
			$pdf->setCell($pX+35, $pY, 20, 5, Tools::num_format($sub->getAttr2()), 'C' ,'LTB');
		break;
		case 'MM':
			$pdf->setCell($pX+35+20, $pY, 21, 5, Tools::num_format($sub->getAttr2()), 'C' ,'LTB');
		break;
	}
}

$pdf->setCell($pX+35+41, $pY, 13.4, 5, 'X', 'C' ,'RLTB');
$pdf->setCell_noUtf8($pX+35+41+13.4, $pY, 23, 5, Tools::num_format_euro($serv->getFee(), 2), 'C');
$pdf->setCell_noUtf8($pX+35+41+13.4+23, $pY, 19, 5, Tools::num_format_euro($serv->getFee(), 2), 'C');

$pdf->setFontSize(FONTDEFAULT);
$pdf->SetTextColor(FONTCOLORDEF);
// servicios adicionales
$pX+=35+41.2;
$pY+=47.6;
$pY2 = $pY;
$pdf->setFontSize(FONTDEFAULT-3);
// canales adicionales
$pdf->setCell($pX, $pY, 13.4, 5.2, ($form['form_chnladd'] > 0)? $form['form_chnladd'] :'', 'C' , 0);
// numeros adicionales
$pY+=5.2;
$pdf->setCell($pX, $pY, 13.4, 5.2, ($form['form_gnumadd'] > 0)? $form['form_gnumadd'] :'', 'C' , 0);

// Total de servicios adicionales
$pX+=13.4 + 23;
$pY = $pY2;

// canales adicionales
if($form['form_chnladd']){
	$sub->selectByCodeService('CHADD');
	$pdf->setCell_noUtf8($pX, $pY, 13.4, 5.2,Tools::num_format_euro($sub->getFee() * $form['form_chnladd'],2), 'C' , 0);
	$cart->addTotal($sub->getFee() * $form['form_chnladd']);
	$cart->addTotalEntry($sub->getEntryFee() * $form['form_chnladd']);
}

// numeros adicionales
$pY+=5.2;
if($form['form_gnumadd']){
	$sub->selectByCodeService('GNUM');
	$pdf->setCell_noUtf8($pX, $pY, 13.4, 5.2, Tools::num_format_euro($sub->getFee() * $form['form_gnumadd'],2),'C' , 0);
	$cart->addTotal($sub->getFee() * $form['form_gnumadd']);
	$cart->addTotalEntry($sub->getEntryFee() * $form['form_gnumadd']);
}
// bonus de mobiles
foreach($cart->getSubServices() as $service){
	$sub->select($service);
	$pY2 = 5.2 * $service;
	$pdf->setFontSize(FONTDEFAULT);
	$pdf->setCell($pX - 13.5 - 23, $pY + $pY2, 13.4, 5.2, 'x', 'C' , 0, 'B');		// BMM 1000 adicionales
	$pdf->setFontSize(FONTDEFAULT-3);
	$pdf->setCell_noUtf8($pX, $pY + $pY2, 13.4, 5.2, Tools::num_format_euro($sub->getFee(),2), 'C' , 0);
}

$pdf->setFontSize(FONTDEFAULT);
$pY+= 21.7;
//form_chnladd
//form_gnumadd
//form_restrictaddicionalnums
//form_restrictinternational
//form_autorizZonaA
//form_gnumport
//form_gnumport_values
//form_autorizinternational
//form_autorizinternational_values
//form['']
if($form['form_gnumport']){
	$pdf->setCell(21, $pY, 4, 4, 'x', 'C' , 'LBTR', 'B');		// Adjuntara solicitud
	$pdf->setFontSize(FONTDEFAULT-5);
	// valores por destino
	$pdf->setCell(21, $pY+30, 169, 5, 'Solicitud portabilidad a: '.$form['form_gnumport_values'], 'L');
	$pdf->setFontSize(FONTDEFAULT);
}
$pY+= 6;
if($form['form_restrictaddicionalnums']){
	$pdf->setCell(21, $pY, 4, 4, 'x', 'C' , 'LBTR', 'B');		// restriccion llamada 80x, 90x, 118xx
}
if($form['form_autorizinternational']){
	$pdf->setCell(89.7, $pY, 4, 4, 'x', 'C' , 'LBTR', 'B');		// autorizacion por destino
	$pdf->setFontSize(FONTDEFAULT-3);
	$pdf->setCell(95, $pY+5, 95, 15, $form['form_autorizinternational_values'], 'L' , 0, 'B');		// valores por destino
	$pdf->setFontSize(FONTDEFAULT);
}
$pY+= 9.3;
if($form['form_restrictinternational']){
	$pdf->setCell(21, $pY, 4, 4, 'x', 'C' , 'LBTR', 'B');		// restricción llamas internacionales
}
$pY+= 6;
if($form['form_autorizZonaA']){
	$pdf->setCell(21, $pY, 4, 4, 'x', 'C' , 'LBTR', 'B');		// autorizacion zona a
}


// Total tarifa contratada
$pdf->printTotal($x + 89.86, $y + 130.8, Tools::num_format_euro($cart->getTotal(), 2), Tools::num_format_euro($cart->getTotalEntry(), 2));

// Fechas
$pdf->printDate($x, $y + 172.8);

$x = 65;
$y = 55.5+48.7;