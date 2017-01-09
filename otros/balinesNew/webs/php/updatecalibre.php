<?php
include_once('funciones.php');
include_once('functions_text.php');
$valor=strtolower(reemplazarForm(quitarPuntos3($_REQUEST['newName'])));
$calibre=$_REQUEST['cargarCals'];
$sms='<div style="position:relative; z-index:997; margin:5px; left:50%; margin-left:-110px;">';
if(sqlQuery('UPDATE calibres SET nombre="'.$valor.'" WHERE idCalibre='.$calibre)){
	$sms.='<span class="idenUserOk">Actualizado correctamente</span>';
}else{
	$sms.='<span class="idenUserFail">No se ha actualizado</span>';
}
echo $sms.'</div>';
?>