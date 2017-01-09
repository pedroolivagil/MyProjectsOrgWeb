<?php
include_once('funciones.php');
include_once('functions_text.php');
$idMarca=$_REQUEST['idMarca'];
$calibre=$_REQUEST['calibre'];
$modelo=$_REQUEST['modelo'];
$posicion=$_REQUEST['posicion'];
$idMenu=$_REQUEST['idMenu'];
?>
<div class="miniTexto tituloSuperior">
	Presiona ESC para salir
	<div id="eliminar" class="iconosOptions cerrarDivX" onclick="cerrarDivs('cargarLoadsGeneral'); cerrarDivs('ajaxLoadFondo');"></div>
</div>
<form enctype="multipart/form-data" onsubmit="return false;" name="formularioUpload" id="formularioUpload">
    <input value="<?php echo $idMarca ?>" name="idMarca" id="idMarca" type="hidden" />
    <input value="<?php echo $calibre ?>" name="calibre" id="calibre" type="hidden" />
    <input value="<?php echo $modelo ?>" name="modelo" id="modelo" type="hidden" />
    <input value="<?php echo $posicion ?>" name="posicion" id="posicion" type="hidden" />
    <input value="<?php echo $idMenu ?>" name="idMenu" id="idMenu" type="hidden" />
    
    <div class="tituloSuperior2">Subir imagen</div>
    <div class="clausulaReg">
        <div class="clave">nombre</div>
        <div>
            <input name="nombre" id="nombre" placeholder="Nombre de la imagen"  class="valor" type="text" maxlength="255" />
        </div>
    </div>
    <div class="clausulaReg">
        <div class="clave">descripcion</div>
        <div>
            <input name="descript" id="descript" placeholder="Descripción de la imagen"  class="valor" type="text" maxlength="255" />
        </div>
    </div>
    <div class="clausulaReg">
        <div class="clave">imagen</div>
        <div>
            <input type="button" value="EXAMINAR" class="valor examinar" onclick="abrirInput('archivos')" style="height:35px; width:206px;" />
            <input id="archivos" type="file" name="archivos[]" style="display:none;" />
        </div>
    </div>
    <div class="clausulaReg">
        <div class="clave">forma caja</div>
        <div>
            <div class="valor" style="float:left; clear:right; margin-bottom:5px;">
                <input type="radio" name="tipo" value="0" style="display:none;" id="tipo1" checked />
                <input type="radio" name="tipo" value="1" style="display:none;" id="tipo2" />
                <input type="radio" name="tipo" value="2" style="display:none;" id="tipo3" />
                <div class="circulo selectedType" id="typeImg1" onClick="abrirInput('tipo1'); cambiarTypeBG(1)" style="float:left; margin-left:40px;"></div>
                <div class="rectangle" id="typeImg2" onClick="abrirInput('tipo2'); cambiarTypeBG(2)" style="float:left; margin-left:10px;"></div>
                <div class="normal" id="typeImg3" onClick="abrirInput('tipo3'); cambiarTypeBG(3)" style="float:left; margin-left:10px;"></div>
            </div>
        </div>
    </div>
    <button onclick="seleccionado()" class="enviarDiv">ENVIAR</button>
</form>
<div id="subir"></div>
<div id="cargados" style="height:80px; clear:both; overflow:hidden;"><!-- Aqui van los archivos cargados --></div>