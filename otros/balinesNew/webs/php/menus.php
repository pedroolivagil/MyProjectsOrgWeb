<?php
include_once('funciones.php');
include_once('functions_text.php');
$con=sqlQuery('SELECT idMarca,nombre,descripcion,imagen FROM marcas ORDER BY 2');
$filas=sqlNumRow($con);
$num=0;
if($filas==0){
?>
<div class="marca" id="submenu<?php echo $num ?>">
	<div style="background:url(img/iconos/info.png) no-repeat center center;"></div>
	<div>No hay marcas</div>
</div>
<?php
++$num;
}else{
while($result=sqlFetch($con)){
?>
<div class="marca" id="submenu<?php echo $num ?>" onclick="cargarSubMenu(<?php echo $result[0] ?>,<?php echo $filas ?>,<?php echo $num ?>)">
	<div style="background:url(<?php echo urlImgSubStr($result[3],'img/iconos/addlogo.png'); ?>) no-repeat center center;"></div>
	<div title="<?php echo (replaceInverse($result[1])); ?>"><?php echo limitarSalida(replaceInverse($result[1]),14); ?></div>
</div>
<?php $num++;}}
if(logUser()){?>
<div class="marca" id="submenu<?php echo $num ?>" onclick="createMarcas()">
	<div style="background:url(<?php echo urlImgSubStr($result[3],'img/iconos/addbrand.png'); ?>) no-repeat center center;"></div>
	<div title="Crear marca rápidamente">añadir marca</div>
</div>
<?php } ?>