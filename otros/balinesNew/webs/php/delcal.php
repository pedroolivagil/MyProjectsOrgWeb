<?php 
include_once('funciones.php');
include_once('functions_text.php');
$idMarca=$_REQUEST['idMarca'];
$idCalibre=$_REQUEST['cargarCals'];
$url='../../img/galeria/'.$idMarca.'/'.$idCalibre;
$url2='../../img/galeria/'.$idMarca.'/logosCalibres/'.$idCalibre;
$sms='<div style="position:relative; z-index:997; margin:5px; left:50%; margin-left:-110px;">';
if(sqlQuery('DELETE FROM calibres WHERE idCalibre='.$idCalibre) and sqlQuery('DELETE FROM columnascalibres WHERE idCalibre='.$idCalibre)){
	if(is_dir($url)){
		if(chmod($url,0744)){
			eliminarDir($url);
			if(rmdir($url)){
				$sms.='<span class="idenUserOk">Imágenes del calibre borradas</span><br /><br />';
			}
		}
	}
	if(is_dir($url2)){
		if(chmod($url2,0744)){
			eliminarDir($url2);
			if(rmdir($url2)){
				$sms.='<span class="idenUserOk">Logos de los modelos borrados</span><br /><br />';
			}
		}
	}
	$sms.='<span class="idenUserOk">Borrada correctamente</span>';
}else{
	$sms.='<span class="idenUserFail">No se ha borrado</span>';
}
echo $sms.'</div>';
?>