<?php 
include_once('funciones.php');
include_once('functions_text.php');
$idMarca=$_REQUEST['idMarca'];
$url='../../img/galeria/'.$idMarca.'/';

$newName=strtolower(reemplazarForm($_REQUEST['newName']));
$sms='<div style="position:relative; z-index:997; margin:5px; left:50%; margin-left:-110px;">';
if(sqlQuery('DELETE FROM marcas WHERE idMarca='.$idMarca) and sqlQuery('DELETE FROM calibres WHERE idMarca='.$idMarca) and sqlQuery('DELETE FROM columnascalibres WHERE idMarca='.$idMarca)){
	if(is_dir($url)){
		if(chmod($url,0744)){
			eliminarDir($url);
			if(rmdir($url)){
				$sms.='<span class="idenUserOk">Imágenes de la marca borradas</span><br /><br />';
			}
		}
	}
	$sms.='<span class="idenUserOk">Borrada correctamente</span>';
}else{
	$sms.='<span class="idenUserFail">No se ha borrado</span>';
}
echo $sms.'</div>';
?>