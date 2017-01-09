<?php
include_once('funciones.php');
include_once('functions_text.php');
$idMarca=$_REQUEST['idMarca'];
$idMenu=$_REQUEST['idMenu'];
?>
<div class="miniTexto tituloSuperior">
	Presiona ESC para salir
	<div id="eliminar" class="iconosOptions cerrarDivX" onclick="cerrarDivs('cargarLoadsGeneral'); cerrarDivs('ajaxLoadFondo');"></div>
</div>

<input value="<?php echo $idMarca ?>" name="idMarca" id="idMarca" type="hidden" />

<div class="tituloSuperior2">Crear un calibre</div>
<div class="clausulaReg">
	<div class="clave">nombre</div>
    <div>
    	<input name="nombre" id="nombre" placeholder="Nombre del calibre" class="valor" type="text" maxlength="255" />
    </div>
</div>
<div class="clausulaReg">
	<div class="clave">calibre</div>
    <div>
    	<input name="tamBalin" id="tamBalin" placeholder="Número de calibre" class="valor" type="text" maxlength="255" />
    </div>
</div>
<div class="clausulaReg">
	<div class="clave">caja</div>
    <div>
    	<input name="tamCaja" id="tamCaja" placeholder="Tamaño de la caja" class="valor" type="text" maxlength="255" />
    </div>
</div>
<div class="clausulaReg">
	<div class="clave">Filas</div>
    <div>
    	<input name="filas" id="filas" placeholder="Numero de filas" class="valor" type="text" maxlength="255" />
    </div>
</div>
<button onclick="crearCalibre(<?php echo $idMenu ?>)" class="enviarDiv">ENVIAR</button>
<div id="subir"></div>
<div id="cargados"><!-- Aqui van los archivos cargados --></div>