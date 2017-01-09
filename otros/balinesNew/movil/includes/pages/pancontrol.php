<div id="pagUserPanel" data-role="page" data-theme="<?php echo themeDef; ?>"<?php echo bgNegro; ?>>
	<?php include("includes/header.php"); ?>
    <?php
	$altura='height:auto; border-color:#CCC;';
    $consultaUser=sqlFetch(sqlQuery('SELECT idenUser, usuario, pasword, email, fechaReg, rangoUser, edad, nombre, apellidos, pais, telefono, nif FROM usuarios WHERE idenUser = '.$_COOKIE['idUser']));
	?>
    <div data-role="content">
    	<div data-form="ui-body-<?php echo themeDef; ?>" class="ui-body ui-body-<?php echo themeDef; ?> ui-corner-all">
            <div class="cabecera" style="text-align:center;">panel de control</div>
            <h4>Hola, <?php echo ucfirst($_COOKIE['usuarioLog']); ?>.</h4>
<div class="ui-grid-a">
    <div class="ui-block-a"><div class="ui-bar ui-bar-o" style=" <?php echo $altura; ?> border-right:0;">
    	<p>F. regístro:<br /><span class="bold"><?php echo defaultValue($consultaUser[4]); ?></span></p>
        <p>Identificador:<br /><span class="bold"><?php echo ponerceros(defaultValue($consultaUser[0]),4); ?></span></p>
        <p>Correo:<br /><span class="bold"><?php echo defaultValue($consultaUser[3]); ?></span></p>
        <p>Rango:<br /><span class="bold"><?php echo defaultValue(rangoUserName($consultaUser[5])); ?></span></p>
    </div></div>
    <div class="ui-block-b"><div class="ui-bar ui-bar-o" style=" <?php echo $altura; ?> border-left:0;">
    	<p>Nombre:<br /><span class="bold"><?php echo defaultValue($consultaUser[7].' '.$consultaUser[8]); ?></span></p>
        <p>País:<br /><span class="bold"><?php echo defaultValue($consultaUser[9]); ?></span></p>
        <p>teléfono:<br /><span class="bold"><?php echo defaultValue($consultaUser[10]); ?></span></p>
        <p>DNI:<br /><span class="bold"><?php echo defaultValue($consultaUser[11]); ?></span></p>
    </div></div>
</div><!-- /grid-a -->
            <br />
            <?php /*?><div style="height:0; width:0; "><input type="file" name="subirFile" id="subirFile" style="visibility:hidden;" /></div><?php */?>
            <div data-role="controlgroup">
            	<a data-role="button" data-icon="user" data-iconpos="left" href="#" <?php echo tipoTrans ?> class="vinculo">editar nombre y/o apellidos</a>
                <a class="vinculo" data-role="button" data-icon="eye" data-iconpos="left" href="#" <?php echo tipoTrans ?>>editar contraseña</a>
                <a class="vinculo" data-role="button" data-icon="mail" data-iconpos="left" href="#" <?php echo tipoTrans ?>>editar correo</a>
                <a class="vinculo" data-role="button" data-icon="location" data-iconpos="left" href="#" <?php echo tipoTrans ?>>editar país</a>
                <a class="vinculo" data-role="button" data-icon="phone" data-iconpos="left" href="#" <?php echo tipoTrans ?>>editar teléfono</a>
                <a class="vinculo" data-role="button" data-icon="star" data-iconpos="left" href="#" <?php echo tipoTrans ?>>editar DNI</a>
               <?php /*?> <a class="vinculo" data-role="button" data-icon="action" data-iconpos="left" href="#" onClick="abrirInput('subirFile');" <?php echo tipoTrans ?>>subir imagen</a><?php */?>
            </div>
            <br />
        </div>
    	<a class="vinculo" data-role="button" data-icon="arrow-l" data-iconpos="left" href="#homePage" <?php echo tipoTrans ?> data-direction="reverse">Volver al inicio</a>
    </div>
</div><!-- /page -->