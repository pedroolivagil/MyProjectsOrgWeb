<?php
include_once('funciones.php');
include_once('functions_text.php');
$idGen=$_REQUEST['idGen'];

$conGen=sqlQuery('SELECT nombre,idCal,idMarca FROM imagenes WHERE idImg='.$idGen);
if($result=sqlFetch($conGen)){
	$ruta='../../img/galeria/'.$result[2].'/'.$result[1].'/'.$result[0];
	$rutathumb='../../img/galeria/'.$result[2].'/'.$result[1].'/thumb/'.$result[0];
}
if(is_file($ruta)){
	if(unlink($ruta)){
		if(unlink($rutathumb)){
			if(sqlQuery('DELETE FROM imagenes WHERE idImg='.$idGen)){
				$sms="Borrado correcto";
			}
		}
	}
}
echo $sms;
?>