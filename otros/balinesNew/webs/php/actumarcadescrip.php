<?php 
include_once('funciones.php');
include_once('functions_text.php');
$idMarca=$_REQUEST['idMarca'];
$newName=strtolower(reemplazarForm(quitarPuntos3($_REQUEST['newName'])));
/*$sms='<div style="position:relative; z-index:997; margin:5px; left:50%; margin-left:-110px;">';*/
if(sqlQuery('UPDATE marcas SET descripcion="'.$newName.'" WHERE idMarca='.$idMarca)){
	/*$sms.='<span class="idenUserOk">Actualizado correctamente</span>';*/
	$sms=ucfirst($newName);
}else{
	/*$sms.='<span class="idenUserFail">No se ha actualizado</span>';*/
	$sms='¡Error!';
}
/*echo $sms.'</div>';*/
echo $sms;
?>