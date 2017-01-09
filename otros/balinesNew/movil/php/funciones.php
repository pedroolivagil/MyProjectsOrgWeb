<?php
include_once('../../webs/php/funciones.php');
include_once('../../webs/php/functions_text.php');

function crearTablaImg($rows,$cols,$arrModelos,$_rows,$_cols,$_marca,$_calibre,$_LIMITE,$anchoWeb){
	$conmodelos=sqlQuery('SELECT nombre,imagen,idColumna FROM columnascalibres WHERE idCalibre='.$_calibre);
	$maxFilas=sqlFetch(sqlQuery('SELECT filas FROM calibres WHERE idMarca='.$_marca.' AND idCalibre='.$_calibre));
	if(sqlNumRow($conmodelos)==0){
		echo 'No hay modelos';
	}else{
		$width='108px';	
		(sqlNumRow($conmodelos)>$_LIMITE)? $resCalc=(($width+2)*$_LIMITE) : $resCalc=(($width+2)*sqlNumRow($conmodelos));
		echo "\n".'<div style="float:none; clear:both; display:block; width:'.$resCalc.'px; margin:0 auto;" id="tablaSelModelo">'."\n";
		for($x=0;$x<sqlNumRow($conmodelos);$x++){
			$result=sqlFetch($conmodelos);
			
			(($x%$_LIMITE)==0)? $grupo=' clear:left;' : $grupo='';
			
			if(sqlNumRow($conmodelos)<$_LIMITE){
				if(($x+1)==sqlNumRow($conmodelos)){
					$borde1='1px'; 
				}else{
					$borde1=0;
				}
				//$width=(99/sqlNumRow($conmodelos)).'%';
			}else if(sqlNumRow($conmodelos)>$_LIMITE and ($x+1)<sqlNumRow($conmodelos)){
				if(($x+1)%$_LIMITE==0){
					$borde1='1px;'; 
				}else{
					$borde1=0;
				}
				//$width='108px';
			}else{
				if(($x+1)==sqlNumRow($conmodelos)){
					$borde1='1px;'; 
				}else{
					$borde1=0;
				}
				//$width='108px';
			}
			
			echo '<div style="width:'.$width.'; height:auto; margin-top:20px; margin-bottom:10px; color:#FFF; float:left;'.$grupo.' border:1px solid #CDCDCD; border-right-width:'.$borde1.'; ">'."\n\t";
			
			echo '<section style="display:table; width:100%;">'."\n\t".'<section style="display:table-cell; border-bottom:1px solid #CDCDCD; height:40px; color:#444; text-align:center; vertical-align:middle;" title="'.replaceInverse($result[0]).'">'.strtoupper(limitarSalida(replaceInverse($result[0]),9)).'</section>'."\n\t".'</section>'."\n";	
			for($c=1;$c<=$maxFilas[0];$c++){
				
				$conImg=sqlFetch(sqlQuery('SELECT nombre,tipo,descripcion,idImg,posicion FROM imagenes WHERE idMarca='.$_marca.' AND idModelo='.$result[2].' AND idCal='.$_calibre.' AND posicion="'.($x+1).','.$c.'" LIMIT 1'));
				
				if($conImg[4]!='' or $conImg[4]!=NULL){
					$estilo=' class="ocupado"';
					$click='';
				}else{
					$estilo='';
					$click=' onClick="selccionarCasilla(\'fila'.$c.'_mod'.$arrModelos[$x][0].'\',\'tablaSelModelo\','.$_rows.','.$_cols.','.$c.')"';
				}
				($c!=1)? $top=' border-top:1px solid #CDCDCD;' : $top='';
				echo '<div style="border:0; '.$top.' height:40px;" '.$estilo.' id="fila'.$c.'_mod'.$arrModelos[$x][0].'" '.$click.'></div>'."\n";
			}
			echo '</div>'."\n";
		}	
		echo '</div>'."\n";	
	}
}
?>