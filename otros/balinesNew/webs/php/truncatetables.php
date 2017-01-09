<?php 
include_once('funciones.php');
include_once('functions_text.php');
$sms='<div style="position:relative; z-index:997; margin:5px; left:50%; margin-left:-110px;">';
if(sqlQuery('TRUNCATE calibres')and sqlQuery('TRUNCATE columnascalibres')and sqlQuery('TRUNCATE imagenes')and sqlQuery('TRUNCATE marcas')){
	$sms.='<span class="idenUserOk">Datos borrados correctamente.</span><br /><br />';
}else{
	$sms.='<span class="idenUserFail">Error al borrar los datos.</span><br /><br />';
}
eliminarDir('../../img/galeria/');
$sms.='<span class="idenUserOk">Imágenes correctamente.</span><br /><br />';
echo $sms.'</div>';
?>