<?php
include_once('php/funciones.php');
include_once('php/functions_text.php');
if(isset($_COOKIE['usuarioLog'])){
?>
<span style="background:url(img/iconos/usuario/user.png) center no-repeat; padding:10px;"></span>
<div style="background:url(img/iconos/usuario/logout2.png) center no-repeat; padding:10px; padding-right:20px; float:right;" onClick="salir()"></div>
<div style="color:#060; float:right;"><?php echo $_COOKIE['usuarioLog'] ?></div>    
<?php
}else{
?>
<span style="background:url(img/iconos/usuario/user.png) center no-repeat; padding:10px; float:left;"></span>
<div style="color:#060; float:left; margin-left:10px;" onClick="abriLogin()">Log In / Sign In</div>
<?php
}
?>