<div id="infobalines" data-role="page" data-theme="<?php echo themeDef; ?>"<?php echo bgNegro; ?>>
	<?php include("includes/header.php"); ?>
    <div data-role="content">
    	<div data-form="ui-body-<?php echo themeDef; ?>" class="ui-body ui-body-<?php echo themeDef; ?> ui-corner-all">
            <div class="cabecera" style="text-align:center;">información</div>
            <div style="text-align:justify;"><?php
            $archivo=file_get_contents_utf8('../info.txt','r');
			echo ($archivo);
			?></div>
        </div>
    	<a class="vinculo" data-role="button" data-icon="arrow-l" data-iconpos="left" href="#homePage" <?php echo tipoTrans ?> data-direction="reverse">Volver al inicio</a>
    </div>
</div><!-- /page -->