<div id="homePage" data-role="page" data-theme="<?php echo themeDef; ?>"<?php echo bgNegro; ?>>	
    <?php include("includes/header.php"); ?>
    <div data-role="content">
    	<div data-role="controlgroup"> 
    	<a class="vinculo" data-role="button" data-icon="bullets" data-iconpos="right" href="#" <?php echo tipoTrans ?>>menu web</a>
    	<a class="vinculo" data-role="button" data-icon="user" data-iconpos="right" href="#checkLogon" <?php echo tipoTrans ?>>panel de usuario</a>
    	<a class="vinculo" data-role="button" data-icon="eye" data-iconpos="right" href="#configWeb" <?php echo tipoTrans ?>>opciones de contenido</a>
    	<a class="vinculo" data-role="button" data-icon="gear" data-iconpos="right" href="#" <?php echo tipoTrans ?>>configuracion web</a>
    	<a class="vinculo" data-role="button" data-icon="info" data-iconpos="right" href="#infobalines" <?php echo tipoTrans ?>>información</a>
        </div>
    </div><!-- /content --> 
</div><!-- /page -->