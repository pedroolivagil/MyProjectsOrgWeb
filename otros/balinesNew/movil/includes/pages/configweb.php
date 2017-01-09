<div id="configWeb" data-role="page" data-theme="<?php echo themeDef; ?>"<?php echo bgNegro; ?>>	
	<?php include("includes/header.php"); ?>
    <div data-role="content">
    	<div data-form="ui-body-<?php echo themeDef; ?>" class="ui-body ui-body-<?php echo themeDef; ?> ui-corner-all">
            <div class="cabecera" style="text-align:center;">Configuración</div>
            <p style="text-align:center;">Configuración de la web respecto al contenido</p>
<!--  data-collapsed="false" -->
<div data-role="collapsible-set">
    <div data-role="collapsible">
        <h3><span class="cab2">nuevo registro</span></h3>
        <p>
<div id="cargados"></div>
<div data-role="collapsible-set">
    <div data-role="collapsible">
        <h3><span class="cab2">marca</span></h3>
        <p><?php include_once("php/opweb/crearmarcas.php"); ?></p>
    </div>
    <div data-role="collapsible">
        <h3><span class="cab2">calibre</span></h3>
        <p><?php include_once("php/opweb/crearcalibres.php"); ?></p>
    </div>
    <div data-role="collapsible">
        <h3><span class="cab2">modelo</span></h3>
        <p><?php include_once("php/opweb/crearmodelos.php"); ?></p>
    </div>
    <div data-role="collapsible">
        <h3><span class="cab2">imagen</span></h3>
        <p><?php include_once("php/opweb/subirimagenes.php"); ?></p>
    </div>        
</div>
		</p>
    </div>
    <!-- 
    <div data-role="collapsible">
        <h3><span class="cab2">editar registro</span></h3>
        <p>

<div data-role="collapsible-set">
    <div data-role="collapsible">
        <h3><span class="cab2">marca</span></h3>
        <p></p>
    </div>
    <div data-role="collapsible">
        <h3><span class="cab2">calibre</span></h3>
        <p></p>
    </div>
    <div data-role="collapsible">
        <h3><span class="cab2">modelo</span></h3>
        <p></p>
    </div>
    <div data-role="collapsible">
        <h3><span class="cab2">imagen</span></h3>
        <p></p>
    </div>        
</div>

		</p>
    </div>
     -->
    <div data-role="collapsible" data-collapsed="false">
        <h3><span class="cab2">eliminar registro</span></h3>
        <p>

<div data-role="collapsible-set">
    <div data-role="collapsible" data-collapsed="false">
        <h3><span class="cab2">imagen</span></h3>
        <p><?php include_once("php/opweb/.php"); ?></p>
    </div>  
    <div data-role="collapsible">
        <h3><span class="cab2">modelo</span></h3>
        <p></p>
    </div> 
    <div data-role="collapsible">
        <h3><span class="cab2">calibre</span></h3>
        <p></p>
    </div>   
    <div data-role="collapsible">
        <h3><span class="cab2">marca</span></h3>
        <p></p>
    </div>  
</div>
		</p>
    </div>        
</div></div>
<a class="vinculo" data-role="button" data-icon="arrow-l" data-iconpos="left" href="#homePage" <?php echo tipoTrans ?> data-direction="reverse">Volver al inicio</a>
    </div><!-- /content -->	
    <?php include("includes/footer.php"); ?>
</div><!-- /page -->
