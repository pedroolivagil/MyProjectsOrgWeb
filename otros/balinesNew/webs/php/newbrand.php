<?php
include_once('funciones.php');
include_once('functions_text.php');
function redimensionar($img,$idMarca,$tipo,$tam){
	switch($tipo){
		case 'jpg':
			$original=imagecreatefromjpeg($img);
		break;
		case 'gif':
			$original=imagecreatefromgif($img);
		break;
		case 'png':
			$original=imagecreatefrompng($img);
		break;
	}
	if($original){
		
		$numero=$tam;
		$ancho = imagesx($original);
		$alto = imagesy($original);
		if($alto>=$ancho){
			$proporcion=$ancho/$alto;
			$thumbalto=$numero;
			$thumbancho=ceil($numero*$proporcion);
		}else{
			//Mas ancho q largo
			$proporcion=$alto/$ancho;
			$thumbancho=$numero;
			$thumbalto=ceil($numero*$proporcion);
		}
		$rutathumb='../../img/galeria/'.$idMarca.'/';
		$thumb = imagecreatetruecolor($thumbancho,$thumbalto);
						
		imagealphablending($thumb,false);
		$tranparente=imagecolorallocatealpha($thumb,0,0,0,0);
		imagefilledrectangle($thumb,0,0,0,0,$tranparente);
		imagecopyresampled($thumb,$original,0,0,0,0,$thumbancho,$thumbalto,$ancho,$alto);
		imagesavealpha($thumb,true);
				
		switch($tipo){
			case 'jpg':
				return imagejpeg($thumb,$rutathumb.'/logo.'.$tipo,100);
			break;
			case 'png':
				return imagepng($thumb,$rutathumb.'/logo.'.$tipo,9);
			break;
			case 'gif':
				return imagegif($thumb,$rutathumb.'/logo.'.$tipo);
			break;
		}
	}
}
$marca=reemplazarForm(quitarPuntos($_POST['nombre']));
$descripcion=reemplazarForm(quitarPuntos3($_POST['descripcion']));
$sms='<div style="position:relative; margin:5px; left:-5px;">';
$ruta="../../img/galeria";
crearDirs('../../img/galeria');
$maximo=sqlFetch(sqlQuery('SELECT MAX(idMarca) FROM marcas'));
($maximo[0]!=NULL)? $max=($maximo[0]+1) : $max=1;
if(sqlQuery('INSERT INTO marcas(idMarca,nombre,descripcion,fechaCreacion)VALUES('.$max.',"'.$marca.'","'.$descripcion.'",NOW())')){	
	crearDirs($ruta.'/'.$max);
	crearDirs($ruta.'/'.$max.'/logosCalibres');
	$sms.='<span class="idenUserOk">Marca creada correctamente.</span><br /><br />';
	foreach ($_FILES as $key) {
		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
			$temporal=$key['tmp_name'];
			$tipoImg=str_replace('jpeg','jpg',str_replace('image/','',$key['type']));
			$tamano=ceil($key['size']/1024/1024);
			if(($tipoImg=='jpg')or($tipoImg=='png')or($tipoImg=='gif')){
				if($tamano<10){
					if(move_uploaded_file($temporal,$ruta.'/logo.'.$tipoImg)){
						$sms.='<span class="idenUserOk">Imagen subida correctamente.</span><br /><br />';
						if(redimensionar($ruta.'/logo.'.$tipoImg,$max,$tipoImg,100)){
							sqlQuery('UPDATE marcas SET imagen="img/galeria/'.$max.'/logo.'.$tipoImg.'" WHERE idMarca='.$max);
							unlink($ruta.'/logo.'.$tipoImg);
						}
					}else{
						$sms.='<span class="idenUserFail">Error al subir imagen.</span><br /><br />';
					}
				}else{
					$sms.='<span class="idenUserFail">Fallo en el tamaño del archivo. Máximo 10MB</span><br /><br />';
				}
			}else{
				$sms.='<span class="idenUserFail">Fallo en el tipo de archivo. Solo PNG, JPEG/JPG o GIF</span><br /><br />';
			}
		}else{
			$sms.='<span class="idenUserFail">'.$key['error'].'</span><br /><br />'; //Si no se cargo mostramos el error
		}
	}
}
echo $sms.'</div>';
?>
