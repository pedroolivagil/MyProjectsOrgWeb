<?php
include_once('funciones.php');
include_once('functions_text.php');
$idMarca=$_REQUEST['idMarca'];
$idCal=$_REQUEST['idCal'];
$idMod=$_REQUEST['idMod'];
$idmenu=$_REQUEST['idmenu'];
if($idMod){
	$texto='Actualizar el ';
	$con=sqlFetch(sqlQuery('SELECT nombre FROM columnascalibres WHERE idColumna='.$idMod));
	$valuePre='value="'.$con[0].'" readonly';
	$actu='si';
}else{
	$texto='Crear un ';
	$valuePre='';
	$actu='no';
}
?>
<div class="miniTexto tituloSuperior">
	Presiona ESC para salir
	<div id="eliminar" class="iconosOptions cerrarDivX" onclick="cerrarDivs('cargarLoadsGeneral'); cerrarDivs('ajaxLoadFondo');"></div>
</div>

<input value="<?php echo $idMarca ?>" name="idMarca" id="idMarca" type="hidden" />
<input value="<?php echo $idCal ?>" name="idCal" id="idCal" type="hidden" />
<input value="<?php echo $idMod ?>" name="idMod" id="idMod" type="hidden" />

<div class="tituloSuperior2"><?php echo $texto; ?>modelo</div>
<div class="clausulaReg">
	<div class="clave">nombre</div>
    <div>
    	<input name="nombre" id="nombre" placeholder="Nombre del modelo" class="valor" type="text" maxlength="255" <?php echo $valuePre; ?> />
    </div>
</div>

<div class="clausulaReg">
	<div class="clave">imagen</div>
    <div>
        <input type="button" value="EXAMINAR" class="valor examinar" onclick="abrirInput('archivos')" style="height:35px; width:206px;" />
        <input id="archivos" type="file" name="archivos[]" style="display:none;" />
    </div>
</div>

<button onclick="crearModelo('<?php echo $actu; ?>',<?php echo $idmenu ?>)" class="enviarDiv">ENVIAR</button>
<div id="subir"></div>
<div id="cargados" style="clear:both;"><!-- Aqui van los archivos cargados --></div>