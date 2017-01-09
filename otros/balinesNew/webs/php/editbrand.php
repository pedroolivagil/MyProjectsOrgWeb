<?php 
include_once('funciones.php');
include_once('functions_text.php');
$opcion=$_REQUEST['opcion'];
if($opcion){ ?>
<div style="padding:10px; background:rgba(0,0,0,.7);">
	<span style="text-transform:uppercase; color:#FFF;">selecciona una marca para renombrarla</span>
    <button onclick="actualizarMarca()" style="width:200px; float:right; margin-top:-5px;">ACTUALIZAR</button>
</div>
<div>
    <div style="width:50%; float:left;">
        <?php 
		$con=sqlQuery('SELECT idMarca,nombre,descripcion,imagen FROM marcas ORDER BY 1');
		$filas=sqlNumRow($con);
		$num=0;
		if($filas==0){
		?>
		<div class="marca" id="submenu<?php echo $num ?>" style="display:block;">
			<div style="background:url(img/iconos/info.png) no-repeat center center;"></div>
			<div>No hay marcas</div>
		</div>
		<?php
		++$num;
		}else{
		?>
        <select name="selBrand" id="selBrand" style="padding:10px; font-size:18px; width:99%; text-align:center; margin:5px 2px; text-transform:uppercase;">
			<option value="0" style="text-transform:uppercase;">-- selecciona --</option>
		<?php while($result=sqlFetch($con)){
		?>
			<option value="<?php echo ($result[0]); ?>" style="text-transform:uppercase;"><?php echo replaceInverse($result[1]); ?></option>
        <?php $num++;} ?>
		</select>
		<?php }?>
    </div>
    <div style="width:50%; float:right; clear:right;">
    	<input name="newName" id="newName" placeholder="Escribe aqui el nuevo nombre" style="padding:10px; font-size:18px; width:91%; text-align:center; margin:5px 2px; text-transform:uppercase;" />
    </div>
    <div id="subir"></div>
    <div id="cargados" style="width:99%; float:left;"><!-- Aqui van los archivos cargados --></div>  
</div>
<?php }else{ ?>
<div style="padding:10px; background:rgba(0,0,0,.7);">
	<span style="text-transform:uppercase; color:#FFF;">selecciona una marca para eliminarla</span>
    <button onclick="borrarMarca()" style="width:200px; float:right; margin-top:-5px;">BORRAR MARCA</button>
</div>
<div>
    <div style="width:100%; float:left;">
        <?php 
		$con=sqlQuery('SELECT idMarca,nombre,descripcion,imagen FROM marcas ORDER BY 1');
		$filas=sqlNumRow($con);
		$num=0;
		if($filas==0){
		?>
		<div class="marca" id="submenu<?php echo $num ?>" style="display:block;">
			<div style="background:url(img/iconos/info.png) no-repeat center center;"></div>
			<div>No hay marcas</div>
		</div>
		<?php
		++$num;
		}else{
		?>
        <select name="selBrand" id="selBrand" style="padding:10px; font-size:18px; width:99%; text-align:center; margin:5px 2px; text-transform:uppercase;">
			<option value="0" style="text-transform:uppercase;">-- selecciona --</option>
		<?php while($result=sqlFetch($con)){
		?>
			<option value="<?php echo ($result[0]); ?>" style="text-transform:uppercase;"><?php echo replaceInverse($result[1]); ?></option>
        <?php $num++;} ?>
		</select>
		<?php }?>
    </div>
    <div id="subir"></div>
    <div id="cargados" style="width:99%; float:left;"><!-- Aqui van los archivos cargados --></div>  
</div>
<?php } ?>