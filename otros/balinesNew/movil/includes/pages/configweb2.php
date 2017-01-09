<div id="configWeb" data-role="page" data-theme="<?php echo themeDef; ?>"<?php echo bgNegro; ?>>	
	<?php include("includes/header.php"); ?>
    <div data-role="content">
    	<div data-form="ui-body-<?php echo themeDef; ?>" class="ui-body ui-body-<?php echo themeDef; ?> ui-corner-all">
            <div class="cabecera" style="text-align:center;">Configuración</div>
            <p style="text-align:center;">Configuración de la web respecto al contenido</p>
<div data-role="controlgroup"> 
	<a class="vinculo" data-role="button" href="#" style="text-align:center;">nuevo registro</a>
    <a class="vinculo" data-role="button" data-icon="plus" data-iconpos="right" href="#" <?php echo tipoTrans ?>>marca</a>
    <a class="vinculo" data-role="button" data-icon="plus" data-iconpos="right" href="#" <?php echo tipoTrans ?>>calibre</a>
    <a class="vinculo" data-role="button" data-icon="plus" data-iconpos="right" href="#" <?php echo tipoTrans ?>>modelo</a>
    <a class="vinculo" data-role="button" data-icon="plus" data-iconpos="right" href="#" <?php echo tipoTrans ?>>imagen</a>
</div>
<br />
<div data-role="controlgroup"> 
    <a class="vinculo" data-role="button" href="#" style="text-align:center;">editar registro</a>
    <a class="vinculo" data-role="button" data-icon="edit" data-iconpos="right" href="#" <?php echo tipoTrans ?>>marca</a>
    <a class="vinculo" data-role="button" data-icon="edit" data-iconpos="right" href="#" <?php echo tipoTrans ?>>calibre</a>
    <a class="vinculo" data-role="button" data-icon="edit" data-iconpos="right" href="#" <?php echo tipoTrans ?>>modelo</a>
    <a class="vinculo" data-role="button" data-icon="edit" data-iconpos="right" href="#" <?php echo tipoTrans ?>>imagen</a>
</div>
<br />
<div data-role="controlgroup"> 
    <a class="vinculo" data-role="button" href="#" style="text-align:center;">eliminar registro</a>
    <a class="vinculo" data-role="button" data-icon="delete" data-iconpos="right" href="#" <?php echo tipoTrans ?>>marca</a>
    <a class="vinculo" data-role="button" data-icon="delete" data-iconpos="right" href="#" <?php echo tipoTrans ?>>calibre</a>
    <a class="vinculo" data-role="button" data-icon="delete" data-iconpos="right" href="#" <?php echo tipoTrans ?>>modelo</a>
    <a class="vinculo" data-role="button" data-icon="delete" data-iconpos="right" href="#" <?php echo tipoTrans ?>>imagen</a>
</div>
</div>
    <a class="vinculo" data-role="button" data-icon="arrow-l" data-iconpos="left" href="#homePage" <?php echo tipoTrans ?> data-direction="reverse">Volver al inicio</a>
    </div><!-- /content -->	
    <?php include("includes/footer.php"); ?>
</div><!-- /page -->
