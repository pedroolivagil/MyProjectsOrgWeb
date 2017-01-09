<div id="dialog" data-role="dialog" data-theme="<?php echo themeDef; ?>">
    <div data-role="header">
        <h1 style="text-transform:uppercase;">cerrar sesión</h1>
    </div>        
    <div data-role="content" style="text-align:center;">
    ¿Seguro que deseas cerrar sesion?<br /><br />
    	<div data-role="controlgroup" data-type="horizontal">
        	<a href="#" class="vinculo" data-role="button" onClick="salir()">si</a> 
        	<a href="#" class="vinculo" data-role="button" data-rel="back">no</a>   
        </div>
        <div id="ajaxLoad">
        </div>
    </div>
</div>