<?php
include_once('funciones.php');
include_once('functions_text.php');
?>
<div class="miniTexto tituloSuperior">
	Presiona ESC para salir
	<div id="eliminar" class="iconosOptions cerrarDivX" onclick="cerrarDivs('cargarLoadsGeneral'); cerrarDivs('ajaxLoadFondo');"></div>
</div>

<div class="tituloSuperior2">Crear una marca</div>

<div class="clausulaReg">
    <div class="clave">nombre</div>
    <div>
        <input name="nombre" id="nombre" placeholder="Nombre de la marca" class="valor" type="text" maxlength="255" />
    </div>
</div>
<div class="clausulaReg">
    <div class="clave">descripcion</div>
    <div>
        <input name="descripcion" id="descripcion" placeholder="Una descripcion general" class="valor" type="text" maxlength="255" />
    </div>
</div>
<div class="clausulaReg">
    <div class="clave">imagen</div>
    <div>
        <input type="button" value="EXAMINAR" class="valor examinar" onclick="abrirInput('archivos')" style="height:35px; width:206px;" />
        <input id="archivos" type="file" name="archivos[]" style="display:none;" />
    </div>
</div>
<button onclick="nuevaMarca()" class="enviarDiv">ENVIAR</button>

<div id="subir"></div>
<div id="cargados"></div>