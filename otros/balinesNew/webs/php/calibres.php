<?php
include_once('funciones.php');
include_once('functions_text.php');
$marca=$_REQUEST['idMarca'];
$calibres=sqlQuery('SELECT idCalibre,nombre FROM calibres WHERE idMarca='.$marca);
$filasCalibre=sqlNumRow($calibres);
if($filasCalibre==0){ ?>
<div style="padding:10px; font-size:18px; width:99%; text-align:center; margin:5px 2px; text-transform:uppercase; background:#FFF;">No hay calibres</div>
<?php }else{
?>
<select id="cargarCals" name="cargarCals" style="padding:10px; font-size:18px; width:99%; text-align:center; margin:5px 2px; text-transform:uppercase;">
<?php
for($q=0;$q<$filasCalibre;$q++){
	$result=sqlFetch($calibres);
?>
	<option value="<?php echo $result[0] ?>"><?php echo replaceInverse($result[1]) ?></option>
<?php } ?>
</select>
<?php } ?>