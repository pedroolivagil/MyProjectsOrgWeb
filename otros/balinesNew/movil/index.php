<?php
include_once('../webs/php/Mobile_Detect.php');  // acuérdate de incluir la ruta correcta    
$detect = new Mobile_Detect(); 
include_once('../webs/php/funciones.php');
include_once('../webs/php/functions_text.php');
?>
<!doctype html>
<html>
<?php
$conOpWeb=sqlFetch(sqlQuery('SELECT letraTema, tipoTrans, background, styles FROM configmovil WHERE idConfig = 1'));
define('themeDef',$conOpWeb[0]); // f,m,n
define('tipoTrans',$conOpWeb[1]);
define('bgNegro',$conOpWeb[2]);
?>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="scripts/jquerymobile/themes/base.min.css">
    
    <link rel="stylesheet" type="text/css" href="scripts/jquerymobile/themes/jquery.mobile.icons.min.css">
    
    <link rel="stylesheet" type="text/css" href="scripts/jquerymobile/jquery.mobile.structure-1.4.4.min.css">
    
    <link rel="stylesheet" type="text/css" href="../css/fonts.css">
    
    <script src="scripts/jquery-1.9.1.js"></script>
    <script src="scripts/jquerymobile/jquery.mobile-1.4.4.min.js"></script>
	<script src="scripts/base_movil.js"></script>
    <style>
	<?php
		if (!($detect->isMobile() or $detect->isTablet())) {
		?>
	.ui-body {
		min-width:555px !important;
	}
	<?php } echo $conOpWeb[3]; ?>
	/*.tablaSelModelo {
		border:1px solid #CDCDCD;
		padding:0;
		text-align:center;
		<?php
		if (!($detect->isMobile() or $detect->isTablet())) {
		?>
		width:100%;
		max-width:530px;
		<?php
		}else{
		?>
		width:530px;
		<?php
		}
		?>		
		margin:10px 5px;
		margin-top:0;
		float:left;
		position:relative;
	}*/
	.ocupado {
		padding:0;
		/*background:#564678;*/
		background:#864552;
		transition-property:background-color;
		transition-duration:.3s;
	}
	#tablaSelModelo div div {
		transition-property:background-color;
		transition-duration:.3s;
	}
	<?php
	if (!($detect->isMobile() or $detect->isTablet())) {
	?>
	#tablaSelModelo div div:hover {
		background:#019FEB;
		border-color:#019FEB;
		transition-property:background-color;
		transition-duration:.3s;
	}	
	<?php
	}
	?>
	.casillaHover {
		background:#069;
		border-color:#069;
		transition-property:background-color;
		transition-duration:.3s;
	}
	/*.tablaSelModelo tr th {
		font-size:1em;*/
		/*font-family:Verdana, Geneva, sans-serif;*/
	/*}*/
	.ui-radio,.ui-btn, .ui-corner-all, .ui-btn-inherit {
		border-color:#DDD !important;
		font-size:1em !important;
	}
	.ui-btn-active {
		color:#EDEDED !important;
		text-shadow:none !important;
	}
	.ui-controlgroup-controls {
		width:100% !important;
		box-shadow:#CCC 0 0 5px;
	}
	.ui-radio {
		font-size:.9em !important;
		width:33.3%;
	}
	.ui-select {
		text-transform:uppercase;
	}
	.ui-controlgroup-controls label {
		text-align:center !important;
		text-transform:uppercase;
	}
	iframe {
		padding:0;
		margin:0;
		border:0;
		width:100%;
		height:50px;
	}
	</style>
</head>
<body>
<?php
// Pagina de inicio
include("includes/pages/home.php");
// Pagina de comprobación de sesión
include("includes/pages/checklogon.php");
// Pagina de login o registro
include("includes/pages/loginuser.php");
// Pagina de cerrar sesión
include("includes/pages/closesesion.php");
// Pagina de cuadro de dialogo
include("includes/pages/dialogexitsesion.php");
// Pagina de informacion 
include("includes/pages/infonalinesmovil.php");
// Pagina de panel de control de usuario
include("includes/pages/pancontrol.php");
// Pagina de configuracion del contenido web
include("includes/pages/configweb.php");
?>
</body>
</html>
