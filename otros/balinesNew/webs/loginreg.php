<?php
include_once('php/funciones.php');
include_once('php/functions_text.php');
?>
<div class="miniTexto tituloSuperior" style="position:relative; top:0px; left:0; background:rgba(0,0,0,.6); width:inherit; padding-left:0; padding-right:0;">
    Presiona ESC para salir
    <div id="eliminar" class="iconosOptions cerrarDivX" onclick="cerrarDivs('cargarLoadsGeneral'); cerrarDivs('ajaxLoadFondo');"></div>
</div>
<div style="width:49.9%; height:338px; float:left; background-color:#F2F2F2; border-right:1px solid #EEE;">
	<div style="position:relative; font-size:14px; text-transform:uppercase; width:100%; margin-top:10px;" onClick="abriLogin()">
    	iniciar sesión
    </div>    
    <div style="width:317px; margin:20px auto;">
        <div class="clausulaReg">
            <div class="clave">nombre/email</div>
            <div>
                <input name="usuario" id="usuario" placeholder="Usuario o email de registro" class="valor" type="text" maxlength="255" />
            </div>
        </div>
        
        <div class="clausulaReg">
            <div class="clave">contraseña</div>
            <div>
                <input name="pasword" id="pasword" placeholder="Contraseña de usuario" class="valor" type="password" maxlength="255" />
            </div>
        </div>
        
        <div class="clausulaReg" style="margin-left:110px; font-size:10px; text-transform:uppercase;">
        	<div style="float:left; line-height:20px; padding:5px;"><input name="autologin" id="autologin" type="checkbox" value="1" /></div>
            <div style="float:left; line-height:25px;"><label for="autologin">Recordar usuario</label></div>
        </div>
        <div style="clear:both; height:40px; line-height:40px;" id="IdenUserLogin">
        	<button onclick="idenUser()">Identificarse</button>
        </div>
        <div style="clear:both; height:30px; position:absolute; bottom:0; font-size:10px;">
        	Si no eres usuario puedes registrarte con el formulario de la derecha.<br />Consulta los <a href="javascript:abrirDiv('cerrarCapsulaDiv')">términos y condiciones de regístro</a>
        </div>
    </div>
</div>
<div style="width:49.9%; height:338px; float:right; background-color:#FFF;" id="registroCompleto">
	<div style="position:relative; font-size:14px; text-transform:uppercase; width:100%; margin-top:10px;">
    	registrarse
    </div>
    <div style="width:317px; margin:20px auto;">
        <div class="clausulaReg">
            <div class="clave">usuario</div>
            <div>
                <input name="usuarioReg" id="usuarioReg" placeholder="Usuario o email de registro" class="valor" type="text" maxlength="255" />
            </div>
        </div>
        
        <div class="clausulaReg">
            <div class="clave">contraseña</div>
            <div>
                <input name="paswordReg" id="paswordReg" placeholder="Contraseña de usuario" class="valor" type="password" maxlength="20" />
            </div>
        </div>
        
        <div class="clausulaReg">
            <div class="clave">email</div>
            <div>
                <input name="email" id="email" placeholder="Email de contacto" class="valor" type="email" maxlength="255" />
            </div>
        </div>
        
        <div class="clausulaReg">
            <div class="clave">edad</div>
            <div>
                <input name="edad" id="edad" placeholder="Edad del usuario, minimo 18" class="valor" type="number" min="18" max="99" />
            </div>
        </div>
        
        <div class="clausulaReg">
            <div class="clave">nombre</div>
            <div>
                <input name="nombre" id="nombre" placeholder="Nombre real" class="valor" type="text" maxlength="255" />
            </div>
        </div>
        
        <div class="clausulaReg">
            <div class="clave">país</div>
            <div>
                <input name="pais" id="pais" placeholder="Apellidos reales" class="valor" type="text" maxlength="255" />
            </div>
        </div>
        
        <div style="clear:both; height:40px; line-height:40px;" id="IdenUserLogin">
        	<button onclick="registrar()">Aceptar términos y registrarse</button>
        </div>
    </div>
</div>
<div id="cerrarCapsulaDiv">
    <div>
    	<span id="eliminar" class="iconosOptions cerrarDivX" onClick="cerrarDiv('cerrarCapsulaDiv')"></span>
    </div>
    <p>Al ingresar en "<strong><?php echo $_SERVER['SERVER_NAME']?></strong>", acuerda estar legalmente sometido a los siguientes términos. En caso contrario por favor no se registre y/o use "<strong><?php echo $_SERVER['SERVER_NAME']?></strong>". Podemos cambiar estos términos en cualquier momento e intentaríamos avisarle, sin embargo sería prudente que los revisase por su cuenta periódicamente. Seguir registrado a "<strong><?php echo $_SERVER['SERVER_NAME']?></strong>" después de esos cambios significa que acuerda estar legalmente sometido a esos nuevos términos tal como fueron actualizados y/o reformados.</p><br /><p>Acuerda no enviar ningun contenido abusivo, obsceno, vulgar, difamatorio, indecente, amenazante, sexual o cualquier otro material que pueda violar cualquier ley de su país, el país donde "<strong><?php echo $_SERVER['SERVER_NAME']?></strong>" está instalado o Leyes Internacionales. Hacer eso provocará que sea inmediata y permanentemente expulsado y, si lo creemos oportuno, con notificación a su Proveedor de Servicios de Internet. Las direcciones IP de todos los envíos son registradas como ayuda para reforzar estas condiciones.</p><br /><p>Como usuario acuerda que cualquier información que haya ingresado será almacenada en una base de datos. Dado que esta información no será compartida con ninguna tercera parte sin su consentimiento, "<strong><?php echo $_SERVER['SERVER_NAME']?></strong>" <strong>NO</strong> podrá considerarse responsable por cualquier intento de hacking que conlleve a que los datos sean comprometidos.</p>
</div>