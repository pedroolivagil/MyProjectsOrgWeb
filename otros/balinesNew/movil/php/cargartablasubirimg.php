<?php
include_once('funciones.php');
define('LIMITE',4);
$idMarca=$_REQUEST['idMarca'];
$idCalibre=$_REQUEST['idCalibre'];
$anchoWeb=$_REQUEST['anchoWeb'];

$conCal=sqlFetch(sqlQuery('SELECT filas FROM calibres WHERE idCalibre='.$idCalibre.' AND idMarca='.$idMarca));

$conModTotal=sqlFetch(sqlQuery('SELECT COUNT(*) FROM columnascalibres WHERE idCalibre='.$idCalibre.' AND idMarca='.$idMarca));

$conMax=sqlFetch(sqlQuery('SELECT MAX(idColumna) FROM columnascalibres WHERE idCalibre='.$idCalibre.' AND idMarca='.$idMarca));

$conMod=sqlQuery('SELECT idColumna,nombre FROM columnascalibres WHERE idCalibre='.$idCalibre.' AND idMarca='.$idMarca);
$arrayModelos=array();
while($result=sqlFetch($conMod)){
	array_push($arrayModelos,array($result[0],$result[1]));
}
if($conModTotal[0]>0){
	echo '<div onclick="ocultarDiv(\'tablaModelos\');" style="font-size:1em; margin-bottom:5px; text-align:center; width:100%; clear:both; width:100%;">mostrar/ocultar</div>';
	echo '<div style="float:left; position:relative; width:50%; height:40px;"><div style="height:20px; width:30px; border:1px solid #546187; float:left;" class="ocupado"></div>Ocupada</div><div style="float:left; position:relative; width:50%; height:40px;">Libre<div style="height:20px; width:30px; border:1px solid #546187; float:right;"></div></div>'."\n";
	echo '<div style="float:none; position:relative; width:50%; height:40px;"><div style="height:20px; width:30px; border:1px solid #546187; float:left; clear:both; " class="casillaHover"></div>Seleccionado</div>'."\n";
	
	$newArray=$arrayModelos;
	crearTablaImg($conCal[0],count($newArray),$newArray,$conCal[0],$conMax[0],$idMarca,$idCalibre,LIMITE,$anchoWeb);
}else{
	echo 'No hay modelos';
}
?>