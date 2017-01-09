<?php
include_once('funciones.php');
include_once('functions_text.php');
$id=$_REQUEST['valor'];	
$nombre=strtolower(reemplazarForm(quitarPuntos3($_REQUEST['contenido'])));
$tabla=$_REQUEST['tabla'];
if(sqlQuery('UPDATE '.$tabla.' SET nombre="'.$nombre.'" WHERE idColumna='.$id)){
	echo $nombre;
}
?>