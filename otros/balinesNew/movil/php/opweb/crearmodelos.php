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
    <div data-role="fieldcontain">
        <div>Selecciona una marca</div>
        <select name="idMarca2" id="idMarca2" style="font-size:1.5em; text-transform:uppercase; text-align:center;" onChange="cargarOptMarca('idCal','idMarca2')">
        <option value="-1">---</option>
        <?php while($result=sqlFetch($con)){?>
            <option value="<?php echo ($result[0]); ?>">
                <?php echo replaceInverse($result[1]); ?>
            </option>
        <?php } ?>
        </select>
		<div>Selecciona un calibre</div>        
        <select name="idCal" id="idCal" style="font-size:1.5em; text-transform:uppercase; text-align:center;" >
            <option value="-1">---</option>
        </select>
    </div>
</div>

<div>
	<div>nombre</div>
    <div>
    	<input name="nombreMod" id="nombreMod" placeholder="Nombre del modelo" type="text" maxlength="255" />
    </div>
</div>
<div>
	<div>imagen</div>
    <div>
        <a class="vinculo" data-role="button" data-icon="action" data-iconpos="left" href="#" onClick="abrirInput('archivos2');" <?php echo tipoTrans ?>>seleccionar imagen</a>
        <div style="height:0; width:0; top:0; left:0; position:absolute;">
        	<input id="archivos2" type="file" name="archivos2[]" style="visibility:hidden;" />
        </div>
    </div>
</div>

<a class="vinculo" data-role="button" data-icon="check" data-iconpos="left" href="#" onClick="crearModelo()" <?php echo tipoTrans ?>>crear modelo</a>

<?php } ?>