<?php
include_once('funciones.php');
include_once('functions_text.php');
$marca=$_REQUEST['idMarca'];
$idCal=$_REQUEST['id'];
$filas=$_REQUEST['filas'];
$idmenu=$_REQUEST['idmenu'];
$conmodelos=sqlQuery('SELECT nombre,imagen,idColumna FROM columnascalibres WHERE idCalibre='.$idCal);
$maxFilas=sqlFetch(sqlQuery('SELECT filas FROM calibres WHERE idMarca='.$marca.' AND idCalibre='.$idCal));
if(sqlNumRow($conmodelos)==0){
?>
<div style="height:100px; padding:20px 0; text-align:center; font-size:26px; text-transform:uppercase;">No se han creado las propiedades de este calibre</div>
<script>abrirDiv2(16,<?php echo $alturaPie ?>)</script>
<?php
}else{
?>
<div id="mostrarImgFinal" style="background:rgba(0,0,0,.5); height:100%; width:100%; position:fixed; z-index:9999; top:0; left:0; display:none;">
	<div class="miniTexto" style="position:relative; background:rgba(0,0,0,1); width:inherit;;">
    Presiona ESC para salir
</div>
	<div id="mostrarImgFinalInterior" style="position:relative; width:1px; height:1px;  margin:auto; top:50%; margin-top:-0.5px;">
    	<div id="imgsMostrarDiv" style="float:left;"></div>        
    </div>
</div>
<?php
	$margin=0;
	if(logUser()){
		$margin=0;
	}	
	for($x=1;$x<=sqlNumRow($conmodelos);$x++){
		$result=sqlFetch($conmodelos);
		if(logUser()){
			$click=' onclick="mostrarEditor(\'ok'.$x.'\','.$x.');"';
			$boleano="true";
		}else{
			$click='';
			$boleano="false";
		}
		if($result[0]!='---'){
			$bg='#FFF';
		}else{
			$bg='#DDD';
		}
		// Cabeceras
?>
<div style="position:absolute; left:<?php echo ($x-1)*104 ?>px; top:<?php echo $margin ?>px;">
	<div class="imgModelo bgcambiable<?php echo $x ?>" style="background-color:<?php echo $bg; ?>;"><?php echo urlImgSubStr3($result[1],urlImgSubStr('img/iconos/addlogo.jpg','img/iconos/addlogo.png'),$marca,$idCal,$result[2],$idmenu) ?></div>
    <div class="tituloModelo bgcambiable<?php echo $x ?>" title="<?php echo (replaceInverse($result[0])); ?>" contenteditable="<?php echo $boleano; ?>" id="titulo<?php echo $x ?>"<?php echo $click; ?> style="background-color:<?php echo $bg; ?>;"><?php echo limitarSalida(replaceInverse($result[0]),15); ?></div>
    <div class="okey" id="ok<?php echo $x ?>" contenteditable="false" onClick="actualizar('titulo<?php echo $x ?>',<?php echo $result[2] ?>,'ok<?php echo $x ?>','columnascalibres',<?php echo $x ?>)"></div>
<?php
		for($c=1;$c<=$maxFilas[0];$c++){
			$conImg=sqlFetch(sqlQuery('SELECT nombre,tipo,descripcion,idImg FROM imagenes WHERE idMarca='.$marca.' AND idModelo='.$result[2].' AND idCal='.$idCal.' AND posicion="'.$x.','.$c.'" LIMIT 1'));
			switch($conImg[1]){
				case 0:
				$class='redondo';
				break;
				case 1:
				$class='recto';
				break;
				case 2:
				default:
				$class='normal1';
				break;
			}
			$url=urlImgSubStr('img/galeria/'.$marca.'/'.$idCal.'/thumb/'.$conImg[0],urlImgSubStr('img/galeria/'.$marca.'/logo.jpg','img/noimg.png'));
			if($conImg!=''){
				$boton='<div class="iconosOptions" id="eliminar" onclick="eliminarImg('.$conImg[3].','.$idmenu.')"></div>';
			}else{
				$boton='<div class="iconosOptions" id="subirImg" onClick="subirImg(\''.$x.','.$c.'\','.$marca.','.$idCal.','.$result[2].','.$idmenu.')"></div>';
			}
			$tam=getimagesize('../../'.$url);
			$alto=$tam[1];
			$class2='margin-top:'.((100-$alto)/2).'px;';
?>
	<div class="divImagen bgcambiable<?php echo $x ?>" style="background-color:<?php echo $bg; ?>;">
    <?php if(logUser()){ echo $boton; } ?>
    	<div class="<?php echo $class ?>" style=" <?php echo $class2 ?>">
        	<?php echo urlImgSubStr2('img/galeria/'.$marca.'/'.$idCal.'/'.$conImg[0],'img/galeria/'.$marca.'/'.$idCal.'/thumb/'.$conImg[0],urlImgSubStr('img/galeria/'.$marca.'/logo.jpg','img/noimg.png'),$conImg[2],$conImg[1]) ?>
        </div>
    </div>
<?php
		}
?>
</div>
<?php
	}
}
?>