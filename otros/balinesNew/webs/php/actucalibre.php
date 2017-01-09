<?php
include_once('funciones.php');
include_once('functions_text.php');
$valor=strtolower(reemplazarForm(quitarPuntos3($_REQUEST['valor'])));
$calibre=$_REQUEST['idCal'];
if(sqlQuery('UPDATE calibres SET filas='.$valor.' WHERE idCalibre='.$calibre)){
	return true;
}
?>