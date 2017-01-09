<?php
$salir=$_POST['salir'];
if(isset($_COOKIE['usuarioLog'])){
	setcookie('usuarioLog','',time()-3600,'/');
	setcookie('passwordLog','',time()-3600,'/');
	setcookie('mantenerLog','',time()-3600,'/');
	setcookie('rangoLog','',time()-3600,'/');
	setcookie('carrito','',time()-3600,'/');
	setcookie('url','',time()-3600,'/');
	setcookie('lang','',time()-3600,'/');
	setcookie('idUser','',time()-3600,'/');
	echo '<div class="textoCarro contenedorAjax" style="line-height:100px;">Has cerrado sesión.'.$salir.'</div>';
}
?>