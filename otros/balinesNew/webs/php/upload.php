<?php
include_once('funciones.php');
include_once('functions_text.php');

$nombre1='balinescoleccion_'.crearIdUnico(10).'_'.reemplazarForm(replace_tildes(quitarPuntos($_POST['nombre'])));
$idMarca1=$_POST['idMarca'];
$calibre1=$_POST['calibre'];
$modelo1=$_POST['modelo'];
$posicion1=$_POST['posicion'];
$descript1=quitarPuntos3($_POST['descript']);
$tipo1=$_POST['tipo'];

subirImgFinal($nombre1,$idMarca1,$calibre1,$modelo1,$posicion1,$descript1,$tipo1);

?>