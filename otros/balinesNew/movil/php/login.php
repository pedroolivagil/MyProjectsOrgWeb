<div data-role="controlgroup">
<?php
if(isset($_COOKIE['usuarioLog'])){
?>
	<h3>Sesión iniciada como: <?php echo ucfirst($_COOKIE['usuarioLog']); ?></h3>
	<a class="vinculo" data-role="button" data-icon="user" data-iconpos="left" href="#pagUserPanel" <?php echo tipoTrans ?>>Ir al panel de usuario</a>
	<a class="vinculo" data-role="button" data-icon="power" data-iconpos="left" href="#closeSession" <?php echo tipoTrans ?>>cerrar la sesión</a>
<?php
}else{
?>
<a class="vinculo" data-role="button" data-icon="lock" data-iconpos="left" href="#loginUser" <?php echo tipoTrans ?>>identificarse</a>
<a class="vinculo" data-role="button" data-icon="plus" data-iconpos="left" href="#loginUser" <?php echo tipoTrans ?>>registrarse</a>
<?php
}
?> <a class="vinculo" data-role="button" data-icon="arrow-l" data-iconpos="left" href="#homePage" <?php echo tipoTrans ?> data-direction="reverse">Volver al inicio</a>
</div>