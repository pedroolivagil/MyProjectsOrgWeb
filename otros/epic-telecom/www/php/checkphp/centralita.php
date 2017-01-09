<?php

$pdf->setFontSize(FONTDEFAULT-4);
$pdf->setText(19,43.5,'Contrato a espera de validación por nuestros técnicos','');
$pdf->setFontSize(FONTDEFAULT);

$x = 135.25;
$y = 59.3;
$h = 7.8;
$w = 12.85;
$b = 0; // 'RLTB';
$pdf->setFontSize(FONTDEFAULT-3);
$pdf->setCell_noUtf8($x+33, $y-$h, $w+8, $h, Tools::num_format_euro($serv->getFee(), 2), 'C', $b);

// precio por extension
$sub->selectByCodeService('INST_EXTENSION');
$pdf->setCell($x, $y, $w, $h, count($cart->getSubServices()), 'C', $b);
$pdf->setCell_noUtf8($x+14, $y, $w+5, $h, Tools::num_format_euro($sub->getFee(), 2), 'C', $b);
$pdf->setCell_noUtf8($x+33, $y, $w+8, $h, Tools::num_format_euro(count($cart->getSubServices()) * $sub->getFee(), 2), 'C', $b);
$y+= $h-.15;

// extensiones
$sel = Tools::getDB()->query('SELECT id, fee, attr1 FROM sub_service WHERE code_service LIKE "EXTENSION"');
while($res = $sel->fetch_row()){
    if($res[1] * $servicios[$res[0]]<=0){        // si el total de extensiones tiene un precio de 0
        $pdf->SetTextColor(FONTCOLOR120);       // significa que no esta seleccionada
    }else{
        $pdf->SetTextColor(FONTCOLORDEF);        
    }
	$pdf->setFontSize(FONTDEFAULT-1);
    $pdf->setCell($x-40, $y, $w+26, $h, $res[2], 'C', $b);      //extension
	$pdf->setFontSize(FONTDEFAULT-3);
    $pdf->setCell($x, $y, $w, $h, ($servicios[$res[0]]<=0)? '---' : $servicios[$res[0]], 'C', $b);
    $pdf->setCell_noUtf8($x+14, $y, $w+5, $h, Tools::num_format_euro($res[1], 2), 'C', $b);
    $pdf->setCell_noUtf8($x+33, $y, $w+8, $h, Tools::num_format_euro($res[1] * $servicios[$res[0]], 2), 'C', $b);
    $y+= $h-.15;
}
$y+= $h;
$pdf->SetTextColor(FONTCOLORDEF);
$pdf->setCell($x-40, $y, $w+26, $h, 'Total terminales', 'C', $b);      //extension
$pdf->setCell($x, $y, $w, $h, count($cart->getSubServices()), 'C', $b);

$y+= $h-.15;
$pdf->setCell($x, $y, $w+16, $h, 'Cuota mensual', 'R', $b);      //extension
$pdf->setFontSize(FONTDEFAULT);
$pdf->setCell_noUtf8($x+30, $y, $w+11, $h, Tools::num_format_euro($cart->getTotal(), 2), 'C', $b);

// precio final de la instalacion
$y+= 22;
$sub->selectByCodeService('INST_EXTENSION');
$pdf->setFontSize(FONTDEFAULT-3);
$pdf->setCell($x, $y, $w, $h, count($cart->getSubServices()), 'C', $b);
$pdf->setCell_noUtf8($x+14, $y, $w+5, $h, Tools::num_format_euro($sub->getEntryFee(), 2), 'C', $b);
$pdf->setCell_noUtf8($x+33, $y, $w+8, $h, Tools::num_format_euro(count($cart->getSubServices())*$sub->getEntryFee(), 2), 'C', $b);

$y+= 5 + $h-.15;
$pdf->setCell($x, $y, $w+16, $h, 'Total instalación', 'R', $b);      //extension
$pdf->setFontSize(FONTDEFAULT);
$pdf->setCell_noUtf8($x+30, $y, $w+11, $h, Tools::num_format_euro(count($cart->getSubServices())*$sub->getEntryFee(), 2), 'C', $b);


$x = 65;
$y = 55.5;
// Fecha
$pdf->printDate($x, $y + 169.5);
$x = 65;
$y = 55.5+48.7;