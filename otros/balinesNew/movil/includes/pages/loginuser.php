<div id="loginUser" data-role="page" data-theme="<?php echo themeDef; ?>"<?php echo bgNegro; ?>>
	<?php include("includes/header.php"); ?>
    <div data-role="content">
        <fieldset data-role="controlgroup">
        	<a class="vinculo" data-role="button" data-icon="arrow-l" data-iconpos="left" href="#homePage" <?php echo tipoTrans ?> data-direction="reverse">Volver al inicio</a>
            <a class="vinculo" data-role="button" style="padding:0px 15px;">
           		<input type="text" id="usuario" name="usuario" placeholder="Usuario o email de registro" maxlength="255" style="padding:15px 10px;" data-clear-btn="true" />
            </a>
            <a class="vinculo" data-role="button" style="padding:0px 15px;">
            	<input type="password" id="pasword" name="pasword" placeholder="Contraseña de usuario" maxlength="255" style="padding:15px 10px;" data-clear-btn="true" />
            </a>
            <input type="checkbox" name="autologin" id="autologin" />
            <label for="autologin">Recordar cuenta</label>
            <a class="vinculo" data-role="button" data-icon="arrow-r" data-iconpos="right" <?php echo tipoTrans ?> onClick="idenUser();">Entrar</a>
        </fieldset>
        <div id="IdenUserLogin">
        </div>
    </div>
</div><!-- /page -->