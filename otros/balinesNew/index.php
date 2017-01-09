<?php
include_once('webs/php/Mobile_Detect.php');  // acuérdate de incluir la ruta correcta    
$detect = new Mobile_Detect(); 
if ($detect->isMobile() or $detect->isTablet()) {
	header("Location: movil/index.php");
	//header("Location: http://m.balinescoleccion.es.mialias.net/");
}
include_once('webs/php/funciones.php');
include_once('webs/php/functions_text.php');
?>
<!doctype html>
<html>
<head>
<title><?php echo $tituloWeb; ?></title>
<meta charset="utf-8">
<meta name="Title" content="Balines" />
<meta name="Author" content="Pedro oliva Gil" />
<meta name="Subject" content="Balines" />
<meta name="Description" content="Pagina web de compra-venta de balines de caza" />
<meta name="Keywords" content="balines,air gun pellets,compra venta de balines,balines de plomo,chumbos,perdigones,marcas de balines,balineras,pellets" />
<meta name="Language" content="Spanish, English" />
<meta name="Revisit" content="30 days" />
<meta name="Distribution" content="Global" />
<meta name="Robots" content="All" />
<link rel="shortcut icon" href="img/fondos/favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
<script src="scripts/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<script src="scripts/base.js"></script>
<!--<script src="scripts/bloquear_clic.js"></script>-->
</head>
<body>
	<div id="cargarLoadsGeneral"></div>
	<div id="ajaxLoadFondo"></div>
	<div id="ajaxLoad"></div>
	<div id="divLoadImg">
    	<section class="miniTexto" style="width:100%;">Presiona ESC para salir</section>
    	<div id="resultLoadImg"></div>
    </div>
    <div id="cabecera">
    	<div id="imgCabecera"></div>
		<?php /*?><div id="visitarForo" onClick="click_link('foro/')">visita nuestro foro</div><?php */?>
    	<div id="bordeBottomCab" style="overflow:hidden; height:20px;">AIR GUN PELLETS, LUFTGEWEHRKUGELN, PLOMBS, CHUMBOS, POSTONES, PALLINI</div>
        <div id="loginMenu"> 
          <?php include_once('webs/login.php'); ?>
        </div>
    </div>
    <div id="divOcultarMostrarMenu" onClick="mostrarMenuIzquierda()">
    	<div id="menu5" class="botonMenu" style="width:75px;">
            <div id="ocultar" style="width:75px;"></div>
        </div>
    </div>
    <div id="menuGeneral">
    	<div id="miniMenus">        
			<?php if(!logUser()){
				$medida=150;	
			}?>
        	<div id="menu1" class="botonMenu boton1" onClick="menus('webs/php/menus.php','menu1','boton1','boton5')" style="width:<?php echo $medida ?>px;" title="Menú principal">
            	<div id="showMenu" style="width:<?php echo $medida ?>px;"></div>
            </div>
			<?php if(logUser()){ ?>
        	<div id="menu2" class="botonMenu boton2" onClick="menus('webs/php/menusedit.php','menu2','boton2','boton6')" title="Opciones generales">
            	<div id="editMenu"></div>
            </div>
        	<div id="menu3" class="botonMenu boton3" onClick="menus('webs/php/menuoptionbd.php','menu3','boton3','boton7')" title="Opciones sobre la base de datos">
            	<div id="delMenu"></div>
            </div>
            <?php } ?>
        	<div id="menu4" class="botonMenu boton4" onClick="ocultarMenuIzquierda()" style="width:<?php echo $medida ?>px;" title="Ocultar menú">
            	<div id="ocultar" style="width:<?php echo $medida ?>px;"></div>
            </div>
        </div>
        <div id="cargaMenus">
   
        </div>
    </div> 
    <div id="mostrarObjetosTabSup">
    	<div class="calibres">seleciona una marca</div>
    </div>
    <div id="mostrarObjetos">
    	<div style="padding:5px; display:none;" id="cuerpoBaseIndex">
            <h2>Bienvenido a Balines</h2>
            <?php
            $archivo=file_get_contents_utf8('info.txt','r');
			echo ($archivo);
			?>
   		</div>
    </div>
	<?php 
    if(logUser()){
        $ancho=floor(100/3);
    }else{
        $ancho=floor(100/2);
    }
	$ancho=floor($ancho/10);
	$ancho=($ancho*10);
	if($ancho==50){
    	$anchoF=($ancho-1.6).'%';
	}else{
    	$anchoF=($ancho+1.7).'%';
	}
    ?>
    <div id="pie">
    	<div style="text-align:center; font-size:10px; text-transform:uppercase; color:#666;">
            <div style="width:100%; float:left; background:rgba(153,153,153,.2); padding:2px 0; height:20px; font-size:18px; font-family:agency_fbregular;" onClick="abrirDiv2(<?php echo $alturaMinPie; ?>,<?php echo $alturaPie; ?>);" id="showHideMenu">Mostrar menú</div>
            
        </div>
        <div>
            <div id="infoMarca" class="opcionesMenuPie" style="height:<?php echo $alturaPie; ?>px; width:<?php echo $anchoF; ?>;">
                <h5 onClick="">Información de la marca</h5>
                <div id="contenidoinfoMarca">
                Seleccione una marca
                </div>
            </div>
            <div id="infoCalibre" class="opcionesMenuPie" style="height:<?php echo $alturaPie; ?>px; width:<?php echo $anchoF; ?>;">
                <h5>Información del calibre</h5>
                <div id="contenidoinfoCalibre">
                Seleccione una marca y un calibre
                </div>
            </div>
            <?php 
            if(logUser()){ ?>
            <div id="opcionesModelos" class="opcionesMenuPie" style="height:<?php echo $alturaPie; ?>px; width:<?php echo $anchoF; ?>;">
                <h5>Herramientas de edición</h5>
                <div id="contenidoopcionesModelos">
                
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
<?php mysqli_close($db);?>
</html>