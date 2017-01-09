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
        <select name="idMarca" id="idMarca" style="font-size:1.5em; text-transform:uppercase; text-align:center;" data-native-menu="true">
        <option value="-1" selected >---</option>
        <?php while($result=sqlFetch($con)){?>
            <option value="<?php echo ($result[0]); ?>">
                <?php echo replaceInverse($result[1]); ?>
            </option>
        <?php } ?>
        </select>
    </div>
</div>
<div>
	<div>nombre</div>
    <div>
    	<input name="nombreCal" id="nombreCal" placeholder="Nombre del calibre" type="text" maxlength="255" />
    </div>
</div>
<div>
	<div>calibre</div>
    <div>
    	<input name="tamBalin" id="tamBalin" placeholder="Número de calibre" type="text" maxlength="255" />
    </div>
</div>
<div>
	<div>caja</div>
    <div>
    	<input name="tamCaja" id="tamCaja" placeholder="Tamaño de la caja" type="text" maxlength="255" />
    </div>
</div>
<div>
	<div>Filas</div>
    <div>
    	<input name="filas" id="filas" placeholder="Numero de filas" type="text" maxlength="255" />
    </div>
</div>

<a class="vinculo" data-role="button" data-icon="check" data-iconpos="left" href="#" onClick="crearCalibre()" <?php echo tipoTrans ?>>crear calibre</a>

<div id="cargados"><!-- Aqui van los archivos cargados --></div>
<?php }?>