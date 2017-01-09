<?php
$x = 20.1;
$y = 57.8;
$b = 'LBT';

$pdf->setFontSize(FONTDEFAULT-4);
$pdf->setText($x, $y, 'Contrato a espera de validación por nuestros técnicos');
$pdf->setFontSize(FONTDEFAULT-2);

$y+= 23.85;
$h = 6;
$w = 106.2;
$wCell = 19;
// fila del servicio
$pdf->setCell($x, $y, 6.7, $h,'x','C',$b);
$pdf->setCell($x + 6.7, $y, $w, $h,' '.$serv->getDescript(),'L',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w, $y, $wCell, $h, Tools::num_format_euro($serv->getFee(),2),'C',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell, $y, $wCell, $h, Tools::num_format_euro($serv->getFeeHigh(),2),'C',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell + $wCell, $y, $wCell, $h, Tools::num_format_euro($serv->getFee(),2),'C',$b.'R');

$y+= $h;
// tarifa plana
foreach($cart->getSubServices() as $id){
    $sub->select($id);
    $pdf->setCell($x, $y, 6.7, $h,'x','C',$b);
    $pdf->setCell($x + 6.7, $y, $w + $wCell, $h,' '.$sub->getDescript(),'L',$b);
    $pdf->setCell_noUtf8($x + 6.7 + $w + $wCell, $y, $wCell, $h, Tools::num_format_euro($sub->getEntryFee(),2),'C',$b);
    $pdf->setCell_noUtf8($x + 6.7 + $w + $wCell + $wCell, $y, $wCell, $h,Tools::num_format_euro($sub->getFee(),2),'C',$b.'R');
}
$y+= $h;
$y+= $h;
// servicios incluidos
$pdf->setCell($x, $y, 6.7, $h,'x','C',$b);
$pdf->setCell($x + 6.7, $y, $w + $wCell, $h,' Antena Exterior y cableado de conexión ','L',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell, $y, $wCell, $h, Tools::num_format_euro(0,2),'C',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell + $wCell, $y, $wCell, $h,Tools::num_format_euro(0,2),'C',$b.'R');
$y+= $h;
$sub->selectByCodeService('STATIC_IP');
$pdf->setCell($x, $y, 6.7, $h,'x','C',$b);
$pdf->setCell($x + 6.7, $y, $w + $wCell, $h,' '.$sub->getDescript(),'L',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell, $y, $wCell, $h, Tools::num_format_euro($sub->getEntryFee(),2),'C',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell + $wCell, $y, $wCell, $h,Tools::num_format_euro($sub->getFee(),2),'C',$b.'R');
$y+= $h; 
$pdf->setCell($x, $y, 6.7, $h,'x','C',$b);
$pdf->setCell($x + 6.7, $y, $w + $wCell, $h,' Router WIFI','L',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell, $y, $wCell, $h, Tools::num_format_euro(0,2),'C',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell + $wCell, $y, $wCell, $h,Tools::num_format_euro(0,2),'C',$b.'R');

$y+= $h; 
$pdf->setCell($x, $y, 6.7, $h,'x','C',$b);
$pdf->setCell($x + 6.7, $y, $w + $wCell, $h, ' Instalación y entrega','L',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell, $y, $wCell, $h,Tools::num_format_euro(0,2),'C',$b);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell + $wCell, $y, $wCell, $h, Tools::num_format_euro(0,2),'C',$b.'R');

$y+= $h; 
$h+= .9; 
// Calculamos los totales y los ponemos.
$totalEntry = ($serv->getFeeHigh() * 2) - $serv->getFeeHigh();
$pdf->setCell($x + 6.7, $y, $w + $wCell, $h,'Total ','R',0);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell, $y, $wCell, $h,Tools::num_format_euro($totalEntry,2),'C','LBR');
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell + $wCell, $y, $wCell, $h, Tools::num_format_euro($cart->getTotal(),2),'C','BR');

$y+= $h;
$pdf->setCell($x + 6.7, $y, $w + $wCell, $h,'Total (IVA)','R',0);
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell, $y, $wCell, $h,Tools::num_format_euro($totalEntry * 1.21, 2),'C','LBR');
$pdf->setCell_noUtf8($x + 6.7 + $w + $wCell + $wCell, $y, $wCell, $h, Tools::num_format_euro($cart->getTotal() * 1.21, 2),'C','BR');

// Fechas
$pdf->printDate($x+44.7, $y+21.2-$h);
$x = 65;
$y = 55.5+35.7;

