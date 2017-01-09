<?php
include_once('funciones.php');
$idMarca=$_REQUEST['idMarca']; 
$con=sqlQuery('SELECT * FROM calibres WHERE idMarca='.$idMarca);
?>
	<option value="-1" selected>---</option>
<?php
while($result=sqlFetch($con)){
?>
	<option value="<?php echo $result[0] ?>" onClick="cargarTablaPosImg('tablaModelos')">
		<?php echo replaceInverse($result[2]); ?>
	</option>
<?php }?>
