<?php
include("php/Mobile_Detect.php");
include_once('php/funciones.php');
include_once('php/functions_text.php');
$detect = new Mobile_Detect();

$autologin=$_REQUEST['autologin'];
$usuario=$_REQUEST['usuario'];
$pasword=$_REQUEST['pasword'];
$userMin=trim(reemplazarForm(replace_tildes($usuario)));
if($autologin){
	$time=$expire;
}else{
	$time=false;
}

$con2User=sqlQuery('SELECT pasword,rangoUser,idenUser,usuario FROM usuarios WHERE usuario LIKE "'.strtolower($userMin).'" OR email LIKE "'.$userMin.'"');
$result=sqlFetch($con2User);
$cifrada=cryptPass($pasword); 

if ($detect->isMobile() or $detect->isTablet()) {	
	$returnIF=login($time,$result[3],$autologin,$result[1],NULL,$result[2])."<script>setTimeout(\"location.href='index.php'\",2000);</script>";
	$returnELSE="Error al acceder.";
}else{
	$returnIF=login($time,$result[3],$autologin,$result[1],NULL,$result[2])."<script>setTimeout(\"location.href='index.php'\",2000);</script>";
	$returnELSE='<div><button onclick="idenUser()">Identificarse</button></div><span class="idenUserFail">Error al acceder.</span>';
}


if($cifrada==$result[0]){
	echo $returnIF;
}else{
	echo $returnELSE;
}
?>