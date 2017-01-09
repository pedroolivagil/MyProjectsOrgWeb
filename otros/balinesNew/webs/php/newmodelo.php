<?php
include_once('funciones.php');
include_once('functions_text.php');
function redimensionar($img,$marca,$calibre,$modelo,$tipo,$tam){
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
		$rutathumb='../../img/galeria/'.$marca.'/logosCalibres/'.$calibre.'/'.$modelo;
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
$sms='<div style="position:relative; margin:5px; left:-5px;">';
$nombre=reemplazarForm(quitarPuntos3($_POST['nombre']));
$idCal=($_POST['idCal']);
$idMarca=($_POST['idMarca']);
$idModelo=($_POST['idMod']);
$actu=($_POST['actu']);
if($idModelo){
	$max=$idModelo;
}else{
	$maximo=sqlFetch(sqlQuery('SELECT MAX(idColumna) FROM columnascalibres'));
	($maximo[0]!=NULL)? $max=($maximo[0]+1) : $max=1;
}
if($actu=='si'){
	$sql=1;
}else{
	$sql=sqlQuery('INSERT INTO columnascalibres(idColumna,idMarca,idCalibre,nombre)VALUES('.$max.','.$idMarca.','.$idCal.',"'.$nombre.'")');
}
crearDirs('../../img/galeria/');
crearDirs('../../img/galeria/'.$idMarca);
$ruta="../../img/galeria/".$idMarca.'/logosCalibres';

if($sql){
	crearDirs($ruta);
	crearDirs($ruta.'/'.$idCal);
	crearDirs($ruta.'/'.$idCal.'/'.$max);
	$sms.='<span class="idenUserOk">Creado/actualizado correctamente.</span><br /><br />';
	foreach ($_FILES as $key) {
		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
			$temporal=$key['tmp_name'];
			$tipoImg=str_replace('jpeg','jpg',str_replace('image/','',$key['type']));
			$tamano=ceil($key['size']/1024/1024);
			if(($tipoImg=='jpg')or($tipoImg=='png')or($tipoImg=='gif')){
				if($tamano<10){
					if(move_uploaded_file($temporal,$ruta.'/logo.'.$tipoImg)){
						$sms.='<span class="idenUserOk">Imagen subida correctamente.</span><br /><br />';
						if(redimensionar($ruta.'/logo.'.$tipoImg,$idMarca,$idCal,$max,$tipoImg,30)){
							sqlQuery('UPDATE columnascalibres SET imagen="img/galeria/'.$idMarca.'/logosCalibres/'.$idCal.'/'.$max.'/logo.'.$tipoImg.'" WHERE idColumna='.$max);
							//unlink($ruta.'/logo.'.$tipoImg);
						}
					}else{
						$sms.='<span class="idenUserFail">Error al subir la imagen.</span><br /><br />';
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
	echo $sms.'</div>';
}
?>