<?php 
include_once('funciones.php');
include_once('functions_text.php');
$opcion=$_REQUEST['opcion'];
switch($opcion){
	case 3:
	case 4:
	echo '<img src="img/fondos/en_construccion.png" style="width:100%; height:auto;">';
	break;
	case 1:
	echo '
    	<div style="padding:5px;">
		<p>Esta opción permite hacer una copia de seguridad de los datos de nuestra base de datos</p>
		<p>Es una opción recomendable para no perder datos importantes.</p>
		<p>También es recomendable hacer una exportación de las imágenes.</p>
		</div>
		
		<div id="subir"></div>
		<div id="cargados"><button onclick="backupBD()" class="enviarDiv" style="width:200px; position:relative; top:50px; left:50%; margin-left:-100px;">Crear Copia de seguridad</button></div>';
	break;
	case 2:
	echo '
    	<div style="padding:5px;">
		<p>Esta opción permite vaciar los datos de nuestra base de datos dejandola con los valores por defecto.</p>
		<p>Es una opción que no se puede deshacer por lo que es recomendable hacer una copia de la base de datos para no perder datos importantes.</p>
		<p>También es recomendable hacer una exportación de las imágenes, pues al restablecer la base de datos también borraremos dichas imágenes.</p>
		</div>
		
		<div id="subir"></div>
		<div id="cargados"><button onclick="vaciarTablas()" class="enviarDiv" style="width:200px; position:relative; top:50px; left:50%; margin-left:-100px;">vaciar tablas</button></div>';
	break;

}
?>