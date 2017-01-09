<?php
require_once('uploadclass.php');
require_once('Herramientas.php');
if($_POST){

	$opciones = new Herramientas();
	
	//$nombre1 = "";
	$nombre		= $opciones->limpiarNombre($opciones->crearIdUnico($_REQUEST['nombreImg']));
	$idMarca	= $opciones->limpiarNombre($_REQUEST['idMarcaImg']);
	$calibre	= $opciones->limpiarNombre($_REQUEST['idCalibreImg']);
	$modelo		= $opciones->limpiarNombre($_REQUEST['colsFinal']);
	$posicion	= $opciones->limpiarNombre($_REQUEST['rowsFinal']);
	$descript	= $opciones->limpiarNombre($_REQUEST['descripcionImg']);
	$tipo		= $opciones->limpiarNombre($_REQUEST['tipo']);
	$posVert	= $opciones->limpiarNombre($_REQUEST['posVert']);
	
	$opciones->crearDirs('../../img/galeria');
	$opciones->crearDirs('../../img/galeria/'.$idMarca);
	$opciones->crearDirs('../../img/galeria/'.$idMarca.'/'.$calibre);
	$opciones->crearDirs('../../img/galeria/'.$idMarca.'/'.$calibre.'/thumb');

	$FILE		= $_FILES['archivosImg'];
	$archivo	= $FILE['name'][0];
	$directorio	= '../../img/galeria/'.$idMarca.'/'.$calibre.'/';	
	$extension	= array('jpg','jpeg','gif','png');
	$size		= $FILE['size'][0];
	$type		= $FILE['type'][0];
	$tmp		= $FILE['tmp_name'][0];
	
	$sql='INSERT INTO imagenes(idCal,idMarca,idModelo,nombre,posicion,fecha,tipo,descripcion)	VALUES('.$calibre.','.$idMarca.','.$modelo.',"'.$nombre.'.'.str_replace('jpeg','jpg',str_replace('image/','',$type)).'","'.$posVert.','.$posicion.'",NOW(),'.$tipo.',"'.$descript.'")';
	
	$UPLOAD = new uploadclass($archivo,$directorio,$extension,$size,$type,$tmp,$nombre,2,$sql);
	$u = $UPLOAD->upLoadFile();
}
?>