<div id="closeSession" data-role="page" data-theme="<?php echo themeDef; ?>"<?php echo bgNegro; ?>>
	<?php include("includes/header.php");
	?>
    <div data-role="content">
    	<div data-form="ui-body-<?php echo themeDef; ?>" class="ui-body ui-body-<?php echo themeDef; ?> ui-corner-all">
        <a class="vinculo" data-role="button" data-icon="delete" data-iconpos="left" data-transition="fade" href="#dialogExitSesion">salir de la sesion</a>
        <a class="vinculo" data-role="button" data-icon="arrow-l" data-iconpos="left" <?php echo tipoTrans ?> data-rel="back" href="#">Volver</a>
        </div>
    </div>
</div>