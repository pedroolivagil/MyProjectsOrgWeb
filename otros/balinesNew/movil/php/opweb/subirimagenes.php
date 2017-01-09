<div>
<?php 
$con=sqlQuery('SELECT idMarca,nombre FROM marcas ORDER BY 1');
$filas=sqlNumRow($con);
if($filas==0){
?>
	<div>No hay marcas</div>
</div>
<?php
}else{
	
?>
    <form id="formularioUpload" name="formularioUpload" method="post" data-ajax="false" action="php/upload.php" enctype="multipart/form-data" onSubmit="return false;" target="cargarImg">
    <div data-role="fieldcontain" style="padding-bottom:0; margin-bottom:0;">
        <input type="hidden" id="rowsFinal" name="rowsFinal" maxlength="255" />
        <input type="hidden" id="colsFinal" name="colsFinal" maxlength="255" />
        <input type="hidden" id="posVert" name="posVert" maxlength="255" />
    	<input name="nombreImg" id="nombreImg" placeholder="Nombre de la imagen" type="text" maxlength="255" />
        <input name="descripcionImg" id="descripcionImg" placeholder="Una descripcion sobre la imagen" type="text" maxlength="255" />
        <div>Selecciona una marca y un calibre</div>        
        <select name="idMarcaImg" id="idMarcaImg" style="font-size:1.5em; text-transform:uppercase; text-align:center;" onChange="cargarOptMarca('idCalibreImg','idMarcaImg')">
        <option value="-1">---</option>
        <?php while($result=sqlFetch($con)){?>
            <option value="<?php echo ($result[0]); ?>" onClick="cargarOptMarca('idCalibreImg','idMarcaImg')">
                <?php echo replaceInverse($result[1]); ?>
            </option>
        <?php } ?>
        </select>
        <select name="idCalibreImg" id="idCalibreImg" style="font-size:1.5em; text-transform:uppercase; text-align:center;" onChange="cargarTablaPosImg('tablaModelos')">
            <option value="-1">---</option>
        </select>        
        <div id="tablaModelos" style="border:0; text-align:center; display:block; width:100%; height:auto; clear:both;">
        	
        </div>
        <div onclick="ocultarDiv('tablaModelos');" style="font-size:1em; margin-bottom:5px; text-align:center; width:100%; clear:both; width:100%;">mostrar/ocultar</div>
        <div style="height:0; width:0; top:0; left:0; position:absolute;">
            <input id="archivosImg" type="file" name="archivosImg[]" style="visibility:hidden; position:absolute; top:0; left:0;" />
        </div>
        <div style=" float:none; clear:both;">
            <a class="vinculo" data-role="button" data-icon="action" data-iconpos="left" href="#" onClick="abrirInput('archivosImg');" <?php echo tipoTrans ?>>seleccionar imagen</a>
        </div>
    	<fieldset data-type="horizontal" data-role="controlgroup" data-corners="true" style="border-radius:5px;">
            <label for="tipo1">Redonda</label>
                <input type="radio" name="tipo" value="0" id="tipo1" checked />
            <label for="tipo2">Rectangular</label>
                <input type="radio" name="tipo" value="1" id="tipo2" />
            <label for="tipo3">Sin cambios</label>
                <input type="radio" name="tipo" value="2" id="tipo3" />
        </fieldset>
    </div>
    </form>
		<a class="vinculo" data-role="button" data-icon="check" data-iconpos="left" href="#" onClick="subirImgMovil()" <?php echo tipoTrans ?>>Subir imagen</a>
    	<!-- <div id="cargarImg"></div> -->
        <iframe id="cargarImg" name="cargarImg" src=""></iframe>        
</div>
<?php }?>