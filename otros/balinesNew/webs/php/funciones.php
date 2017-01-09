<?php error_reporting(0);  //E_ALL ^ E_NOTICE -> para ver err
$expire=time()+60*60*24*7;
$dbhost='localhost';
$dbname='balinesnew';
if(($_SERVER['SERVER_NAME']=='localhost')or($_SERVER['SERVER_NAME']=='192.168.0.192')){
	$dbuser='root';
	$dbpasswd='20081991_A';
}elseif($_SERVER['SERVER_NAME']=='balines.webcindario.com'){
	$dbhost='mysql.webcindario.com';
	$dbname='balines';
	$dbuser='balines';
	$dbpasswd='20081991_A';
}else{
	$dbuser='mybalinesc';
	$dbpasswd='Y4M9M1Zi';
}
$tituloWeb='Balines';
$db=mysqli_connect($dbhost,$dbuser,$dbpasswd,$dbname);
mysqli_query($db,"SET NAMES 'utf8'");
@mysqli_set_charset('utf8');
@header("Content-type: text/html; charset=utf8");
function sqlQuery($var){
	global $db;
	return mysqli_query($db,$var);
}
function sqlFetch($var){
	return mysqli_fetch_array($var);
}
function sqlNumRow($var){
	return mysqli_num_rows($var);
}
function cryptPass($pasword){
	if (CRYPT_BLOWFISH == 1) {
    	$criptPass=crypt($pasword,'$2a$07$BaLIneS52570b6fcf2eb$');
		return $criptPass;
	}
}
function login($finCookie=false,$user,$mantenerCh=0,$rango,$lang='es_es',$iduser){
	($finCookie)? $expire=$finCookie : $expire=time()+3600;
	setcookie('usuarioLog',$user,$expire,'/');
	setcookie('mantenerLog',$mantenerCh,$expire,'/');
	setcookie('rangoLog',$rango,$expire,'/');
	setcookie('lang',$lang,$expire,'/');
	setcookie('idUser',$iduser,$expire,'/');
	return '<span class="idenUserOk">Identificado correctamente.</span>';
}
function ponerceros($num,$cantChars=1){
	$cantChars++;
	$code="%0".$cantChars."d";
	printf($code, $num);
}
function crearIdUnico($leng){
	return substr(md5(microtime()),0,$leng);
}
function crearDirs($var){
	if(is_dir($var)){
		chmod($var,0744);
	}else{
		mkdir($var,0744);
	}
	return true;
}
function comprobarDirs($dirFinal,$base){
	$ruta=explode('/',$dirFinal);
	$dirs=$base;
	foreach ($ruta as $dir){
		if(is_dir($dirs.$ruta)){
			$dirs.='/'.$ruta;
		}
	}
	return $dirs;
}
function eliminarDir($url,$old){
	$abrir=opendir($url);
	while($ficheros=readdir($abrir)){
		if(($ficheros!='.')and($ficheros!='..')){
			if(is_dir($url.'/'.$ficheros)){
				eliminarDir($url.'/'.$ficheros,$old);
			}else{
				unlink($url.'/'.$ficheros);
			}
			rmdir($url.'/'.$ficheros);
		}
	}
	closedir($abrir);
}
function urlImgSubStr($url,$default){
	if(is_file('../../'.$url)){
		$logo=$url;
	}else{
		$logo=$default;
	}
	return $logo;
}

function urlImgSubStr2($url,$thumb,$default,$descript,$tipo){
	$ruta=urlImgSubStr($url,$default);
	$rutaThumb=urlImgSubStr($thumb,$default);
	if($ruta!=$url){
		$rutaLink[0]='';
		$rutaLink[1]='';
		$rutaLink[2]='style="opacity:.3;"';
	}else{
		$tam=getimagesize('../../'.$ruta);
		$ancho=$tam[0];
		$alto=$tam[1];
		$rutaLink[0]='<a onClick="mostrarImg(\''.$ruta.'\','.$ancho.','.$alto.','.$tipo.',\''.$descript.'\')">';
		$rutaLink[1]='</a>';
		$rutaLink[2]='style="opacity:1;"';
	}
	$final=$rutaLink[0].'<img src="'.$rutaThumb.'" name="max_width" '.$rutaLink[2].' />'.$rutaLink[1];
	return $final;
}
function urlImgSubStr3($url,$default,$marca,$idCal,$modelo,$idmenu){
	$ruta=urlImgSubStr($url,$default);
	if(!is_file('../../'.$url)){
		if(logUser()){
			$funcion='onclick="subirLogoModelo('.$marca.','.$idCal.','.$modelo.','.$idmenu.')"';
		}else{
			$funcion='';
		}
	}else{
		$funcion='';
	}
	$final='<div style="background:url('.$ruta.') no-repeat center; height:28px; width:28px; margin:1px auto;" '.$funcion.'></div>';
	return $final;
}
function logUser(){
	if(isset($_COOKIE['rangoLog']) and $_COOKIE['rangoLog']==1){
		return true;
	}else{
		return false;
	}
}
function rangoUserName($iden){
	if($iden==1){
		return "Administrador";
	}else{
		return "Usuario estándard";
	}
}

function file_get_contents_utf8($fn) {
	$content = file_get_contents($fn);
	return utf8_encode($content);
}

function crearThumb($img,$ruta2,$tipo,$tam){
	switch($tipo){
		case 'jpg':
			$original=imagecreatefromjpeg($ruta2.'/'.$img);
		break;
		case 'gif':
			$original=imagecreatefromgif($ruta2.'/'.$img);
		break;
		case 'png':
			$original=imagecreatefrompng($ruta2.'/'.$img);
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
		$rutathumb=$ruta2.'/thumb';				
		crearDirs($rutathumb);
		$thumb = imagecreatetruecolor($thumbancho,$thumbalto);
						
		imagealphablending($thumb,false);
		$tranparente=imagecolorallocatealpha($thumb,0,0,0,0);
		imagefilledrectangle($thumb,0,0,0,0,$tranparente);
		imagecopyresampled($thumb,$original,0,0,0,0,$thumbancho,$thumbalto,$ancho,$alto);
		imagesavealpha($thumb,true);
				
		switch($tipo){
			case 'jpg':
				return imagejpeg($thumb,$rutathumb.'/'.$img,100);
			break;
			case 'png':
				return imagepng($thumb,$rutathumb.'/'.$img,9);
			break;
			case 'gif':
				return imagegif($thumb,$rutathumb.'/'.$img);
			break;
		}
	}
}
function subirImgFinal($nombre,$idMarca,$calibre,$modelo,$posicion,$descript,$tipo){
	$ruta="../../img/galeria/".$idMarca."/".$calibre;
	crearDirs('../../img/galeria');
	crearDirs('../../img/galeria/'.$idMarca);
	crearDirs($ruta);
	$sms='<div style="position:relative; margin:5px; left:-5px;">';
	//Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
	foreach ($_FILES as $key) {
		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
			$temporal=$key['tmp_name'];
			//$nombre2=$key['name'];
			$tipoImg=str_replace('jpeg','jpg',str_replace('image/','',$key['type']));
			$tamano=ceil($key['size']/1024/1024);
			if(($tipoImg=='jpg')or($tipoImg=='png')or($tipoImg=='gif')){
				if($tamano<10){
					if(move_uploaded_file($temporal,$ruta.'/'.$nombre.'.'.$tipoImg)){
						$sms.='<span class="idenUserOk">Imagen subida correctamente.</span><br /><br />';
						if(sqlQuery('INSERT INTO imagenes(idCal,idMarca,idModelo,nombre,posicion,fecha,tipo,descripcion) VALUES('.$calibre.','.$idMarca.','.$modelo.',"'.$nombre.'.'.$tipoImg.'","'.$posicion.'",NOW(),'.$tipo.',"'.$descript.'")')){
							$sms.='<span class="idenUserOk">Imagen registrada correctamente.</span><br /><br /><script>setTimeout(\'cerrarDivsBase()\',2000)</script>';
						}
						crearThumb($nombre.'.'.$tipoImg,$ruta,$tipoImg,100);
					}
				}else{
					$sms='<span class="idenUserFail">Fallo en el tamaño del archivo. Máximo 10MB.</span><br /><br />';
				}
			}else{
				$sms='<span class="idenUserFail">Fallo en el tipo de archivo. Solo PNG, JPEG/JPG o GIF.</span><br /><br />';
			}
		}else{
			$sms='<span class="idenUserFail">'.$key['error'].'</span><br /><br />'; //Si no se cargo mostramos el error
		}
	}
	echo $sms.'</div>';
}

$ruta=$_SERVER['PHP_SELF'];
$ruta=pathinfo($ruta);
$pagina=$ruta['basename'];
if($_SERVER['QUERY_STRING']!=''){
	$pagina.='?'.$_SERVER['QUERY_STRING'];
}
$alturaPie=140;
$alturaMinPie=26;
?>