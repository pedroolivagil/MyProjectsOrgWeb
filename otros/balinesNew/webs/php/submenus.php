<?php
include_once('funciones.php');
include_once('functions_text.php');
$marca=$_REQUEST['idMarca'];
$idMenu=$_REQUEST['idMenu'];
$calibres=sqlQuery('SELECT idCalibre,idMarca,nombre,tamBalin,tamCaja,filas FROM calibres WHERE idMarca='.$marca);
$num=0;
$filasCalibre=sqlNumRow($calibres);
if(logUser()){
?>
<div id="calibre" class="calibres" onClick="createCalibres(<?php echo $marca ?>,<?php echo $idMenu ?>)" style="height:27px; width:28px;"><img src="img/iconos/addbrand.png" style="margin:-2px;" /></div> 
<?php }
if(sqlNumRow($calibres)==0){
?>
	<div class="calibres">no hay calibres</div>
<?php
}else{
	while($result=sqlFetch($calibres)){
?>
	<div id="calibre<?php echo $num ?>" class="calibres" onClick="subMenuModelos(<?php echo $marca ?>,<?php echo $filasCalibre ?>,<?php echo $num ?>,<?php echo $result[5] ?>,<?php echo $result[0] ?>);"><?php echo replaceInverse(limitarSalida($result[2],20)); ?></div>
<?php
	$num++;
	}
}
?>