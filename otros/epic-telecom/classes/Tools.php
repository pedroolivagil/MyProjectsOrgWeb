<?php
# Almacxena todas las herramiendas para dar formato a la web, obtener datos, etc.
# cada método teien su propio comentario sobre su función

abstract class Tools {	
	private static $db;
	private static $l;
	public static $lang;
	
	public static function init($lang = 'es', $upkeep = false){
		// inicializa las opciones
		Tools::DB();
		Tools::$l = new Locale($lang);
		Tools::$lang = $lang;
		Tools::isUpkeep($upkeep);
	}
	public static function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];
		   
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
	   
		return $_SERVER['REMOTE_ADDR'];
	}
	private static function isUpkeep($bool){
		// si bool es True, la pagina se queda en mantenimiento y solo visible para las ip disponibles
		$ips = array('79.156.144.44','146.66.253.232');
		if($bool){
			if(!array_search(Tools::getRealIP(), $ips)){
				header('Location: mantenimiento');
				exit;
			}
		}
	}
	private static function DB(){
		// establece la conexion a la base de datos
		Tools::$db = new mysqli(dbhost, dbuser, dbpass, dbname);
		if (Tools::$db->connect_error) {
			die('Error de Conexión ('.Tools::$db->connect_errno.') '.Tools::$db->connect_error);
		}
		Tools::$db->query("SET NAMES 'utf8'");
	}	
	public static function getLocale(){
		return Tools::$l;
	}	
	public static function getDB(){
		// devuelve la base de datos
		return Tools::$db;
	}
	public static function closeDB(){
		// cierra la conexion de la base de datos
		Tools::$db->close();
	}
	public static function cryptString($str){
		// encripta un string con codificación blowfish
		if (CRYPT_BLOWFISH == 1) {
			return crypt($str,'$2a$07$EpiCTelEcOm52570b6fcf2eb$');
		}
	}	
	public static function setCookie($id, $value){
		setcookie($id, $value, EXPIRE, '/');
	}	
	public static function getCookie($id){
		return $_COOKIE[$id];
	}
	public static function setNewCart(){
		if(Tools::isEmpty(Tools::getCookie(_CART_)) or Tools::getCookie(_CART_) == NULL ){
			$cesta = new Cart();
			Tools::setCart($cesta);
		}
	}
	public static function setCart($cesta){
		Tools::setCookie(_CART_, base64_encode(serialize($cesta)));
	}	
	public static function getCart(){
		return unserialize(base64_decode($_COOKIE[_CART_]));
	}
	public static function uniqID($leng){
		// genera un ID único basándose en la hora
		return substr(md5(microtime()),0,$leng);
	}
	public static function getMonth($number){
		// retorna un string del mes del año segun el idioma escogido
		$m = Tools::getLocale()->getString('MONTH');
		return $m[$number-1];
	}
	public static function separator(){
		return "\n<div class='line'></div>";
	}
	public static function perms($url){
		return substr(sprintf('%o', fileperms($url)),-4);
	}
	public static function ch_mod777($url){
		chmod($url,0777);
	}
	public static function ch_mod755($url){
		chmod($url,0755);
	}
	public static function newDir($url){
		// crea y/o da permisos 777 al directorio $url
		return (is_dir($url))? Tools::ch_mod777($url) : mkdir($url,0777);
	}	
	public static function rmDots($str){
		// quita los puntos de un string
		$char=array(',','.',';',':','·');
		return trim(str_replace($char,'',$str));
	}	
	public static function rmIlegalChars($str){
		// quita los carácteres especiales de un string
		$char=array('/','<','>','º','ª','\\','&','!','"','·','$','%','(',')','\'','?','¡','¿','|','#','~','€','¬','{','}','[',']','`','´');
		return trim(str_replace($char,'',$str));
	}	
	public static function cleanArrIlegalChars($arr){
		// quita los carácteres especiales de un string
		foreach($arr as $key => $val){
			$arr[$key] = Tools::rmIlegalChars($arr[$key]);
		}
		return $arr;
	}	
	public static function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}	
	public static function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}
	public static function cutOutput($str, $limite){
		$longWeight=strlen($str);
		if($longWeight>$limite){
			$frase=substr($str,0,$limite).'...';
		}else{
			$frase=$str;
		}
		return $frase;
	}
	public static function fillArray($sql){
		// rellena un array a partir de una consulta sql de varios resultados
		$array = array();
		if($res = $sql->fetch_array()){
			do{
				array_push($array, $res);
			}while($res = $sql->fetch_array());
		}
		return $array;
	}
	public static function is_number($mixed){
		return is_numeric($mixed);
	}
	public static function zerofill($str, $zero = 11){
		$z = '';
		for($x = 0; strlen($z) < ($zero - strlen($str)); $x++){
			$z.= '0';
		}
		return $z.$str;
	}
	public static function phonef($phone){
		$phone = str_replace(' ', '',trim($phone));
		return substr($phone,0,3).' '.substr($phone,3,2).' '.substr($phone,5,2).' '.substr($phone,7,2);
	}
	public static function isPhone($phone){
		return preg_match('/^[6-9]{1}[0-9]{8}$/',$phone);
	}
	public static function isEmpty($var){
		/* Devuelve TRUE si variable es NULL o esta vacía */
		if($var != '' or $var != NULL){
			return false;
		}
		return true;
	}
	public static function num_format_euro($num, $decimals=0){
		// añade el símbolo euro
		// windows-1252
		// ISO-8859-1//TRANSLIT
		return Tools::num_format($num, $decimals).iconv('UTF-8', 'windows-1252','€');
	}
	public static function num_format($num, $decimals=0){
		// da formato a un número con X decimales
		return number_format($num, $decimals,',','.');
	}
	public static function checkIdent($cif) {
		// comprueba el string($cif) si es válido o no.
		// Returns:
		// 1 = NIF ok,
		// -1 = NIF bad,
		// 2 = CIF ok,
		// -2 = CIF bad,
		// 3 = NIE ok,
		// -3 = NIE bad, 
		// 0 = ??? bad
		$cif = strtoupper($cif);
		for ($i = 0; $i < 9; $i++) {
			$num[$i] = substr($cif, $i, 1);
		}
		// si no tiene un formato valido devuelve error
		if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $cif)) { return 0; }
		// comprobacion de NIFs estandar
		if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $cif)) {
			if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1)) {
				return 1;
			} else { return -1; }
		}
		// algoritmo para comprobacion de codigos tipo CIF
		$suma = $num[2] + $num[4] + $num[6];
		for ($i = 1; $i < 8; $i+= 2) {
			$suma+= substr((2 * $num[$i]) , 0, 1) + substr((2 * $num[$i]) , 1, 1);
		}
		$n = 10 - substr($suma, strlen($suma) - 1, 1);
		// comprobacion de NIFs especiales (se calculan como CIFs)
		if (preg_match('/^[KLM]{1}/', $cif)) {
			if ($num[8] == chr(64 + $n)) { return 1; } else { return -1;	}
		}
		// comprobacion de CIFs
		if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)) {
			if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1)) {
				return 2;
			} else { return -2; }
		}
		// comprobacion de NIEs
		// T
		if (preg_match('/^[T]{1}/', $cif)) {
			if ($num[8] == preg_match('/^[T]{1}[A-Z0-9]{8}$/', $cif)) {
				return 3;
			} else { return -3; }
		}
		// XYZ
		if (preg_match('/^[XYZ]{1}/', $cif)) {
			if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X','Y','Z') , array('0','1','2') , $cif) , 0, 8) % 23, 1)) {
				return 3;
			} else { return -3; }
		}
		// si todavia no se ha verificado devuelve error
		return 0;
	}
	public static function checkSwift($swift){
		if(preg_match('/^([a-zA-Z]){4}([a-zA-Z]){2}([0-9a-zA-Z]){2}([0-9a-zA-Z]{3})?$/',$swift)){
			return true;
		}
		return false;
	}
	public static function checkIBAN($iban){
		// comprobar el iban es correcto
	   $iban=trim($iban);
	   $iban=strtoupper($iban);	
	   if(strlen($iban)!=24){
		  return false;
	   } else {
		  $letra1 = substr($iban, 0, 1);
		  $letra2 = substr($iban, 1, 1);	
		  $num1 = Tools::numeroLetra($letra1);
		  $num2 = Tools::numeroLetra($letra2);
		  $final= substr($iban, 2, 2);
		  $temp = substr($iban, 4, strlen($iban)).$num1.$num2.$final;
		  if(bcmod($temp, 97) == 1) {
			 return true;
		  } else {
			 return false;
		  }
	   }
	}	
	private static function numeroLetra($letra){	
	   $letras["A"]=10;
	   $letras["B"]=11;
	   $letras["C"]=12;
	   $letras["D"]=13;
	   $letras["E"]=14;
	   $letras["F"]=15;
	   $letras["G"]=16;
	   $letras["H"]=17;
	   $letras["I"]=18;
	   $letras["J"]=19;
	   $letras["K"]=20;
	   $letras["L"]=21;
	   $letras["M"]=22;
	   $letras["N"]=23;
	   $letras["O"]=24;
	   $letras["P"]=25;
	   $letras["Q"]=26;
	   $letras["R"]=27;
	   $letras["S"]=28;
	   $letras["T"]=29;
	   $letras["U"]=30;
	   $letras["V"]=31;
	   $letras["W"]=32;
	   $letras["X"]=33;
	   $letras["Y"]=34;
	   $letras["Z"]=35;	
	   return($letras[$letra]);
	}
	public static function getExtension($url){
		$info = pathinfo($url);
		return $info['extension'];
	}
	public static function getimagesizefromstring($url){
		if (!function_exists('getimagesizefromstring')) {
			function getimagesizefromstring($url)
			{
				$uri = 'data://application/octet-stream;base64,'.base64_encode($url);
				return getimagesize($uri);
			}
		}else{
			return getimagesizefromstring($url);
		}
	}
    public static function resizeImg($anchoOriginal, $altoOriginal, $anchoDeseado) {
        return ($anchoDeseado * $altoOriginal) / $anchoOriginal;
    }
	public static function redimensionar($img,$ruta,$tipo,$tam){
		// redimensiona una imagen proporcionalmente
		switch($tipo){
			case 'jpg':
				$original=imagecreatefromjpeg($ruta.$img);
			break;
			case 'gif':
				$original=imagecreatefromgif($ruta.$img);
			break;
			case 'png':
				$original=imagecreatefrompng($ruta.$img);
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
			$rutathumb=$ruta.'thumb/';
			$thumb = imagecreatetruecolor($thumbancho,$thumbalto);
							
			imagealphablending($thumb,false);
			$tranparente=imagecolorallocatealpha($thumb,0,0,0,0);
			imagefilledrectangle($thumb,0,0,0,0,$tranparente);
			imagecopyresampled($thumb,$original,0,0,0,0,$thumbancho,$thumbalto,$ancho,$alto);
			imagesavealpha($thumb,true);
					
			switch($tipo){
				case 'jpg':
					return imagejpeg($thumb,$rutathumb.$img,100);
				break;
				case 'png':
					return imagepng($thumb,$rutathumb.$img,9);
				break;
				case 'gif':
					return imagegif($thumb,$rutathumb.$img);
				break;
			}
		}
	}
	public static function htmlEntityDecode($tpl){
		return html_entity_decode($tpl, ENT_QUOTES, 'UTF-8');
	}
	public static function getContentOfFile($url, $params = false, $values = false){
		$txt="";
		Tools::ch_mod777($url);
		$file = fopen($url, "r") or exit("Error de lectura de 'Header'");
		//Output a line of the file until the end is reached
		while(!feof($file)) {
			if($params && $values){
				$txt.= str_replace($params,$values,fgets($file)). "\n";
			}else{
				$txt.= fgets($file). "\n";
			}
		}
		fclose($file);
		Tools::ch_mod755($url);
		return $txt;
	}
	public static function getLegalWarning($name){
		$txt="";
		Tools::ch_mod777($name);
		$file = fopen($name, "r") or exit("Error de lectura de 'Aviso Legal'");
		//Output a line of the file until the end is reached
		while(!feof($file)) {
			$txt.= fgets($file). "\n";
		}
		fclose($file);
		Tools::ch_mod755($name);
		return $txt;
	}
	public static function getMailBodyPwd($name, $pass){	
		$txt="";
		Tools::ch_mod777(MAILBODY_NEWUSER);
		$file = fopen(MAILBODY_NEWUSER, "r") or exit("Error al abrir signin.txt!");
		//Output a line of the file until the end is reached
		while(!feof($file)) {
			$txt.= 
			str_replace('[NAME]',ucfirst($name),str_replace('[PASS]',$pass,fgets($file))). "\n";
		}
		fclose($file);
		Tools::ch_mod755(MAILBODY_NEWUSER);
		return $txt;
	}
	public static function getMailBodyUser($name, $username, $pass, $mail){	
		$txt="";
		Tools::ch_mod777(MAILBODY_NEWUSER);
		$file = fopen(MAILBODY_NEWUSER, "r") or exit("Error al abrir signin.txt!");
		//Output a line of the file until the end is reached
		while(!feof($file)) {
			$txt.= 
			str_replace('[MAIL]',$mail,str_replace('[NAME]',ucfirst($name),str_replace('[USERNAME]',$username,str_replace('[PASS]',$pass,fgets($file))))). "\n";
		}
		fclose($file);
		Tools::ch_mod755(MAILBODY_NEWUSER);
		return $txt;
	}
	public static function getMailBodyContrato($name){
		$txt="";
		Tools::ch_mod777(MAILBODY_NEWORDER);
		$file = fopen(MAILBODY_NEWORDER, "r") or exit("Error al abrir bought.txt!");
		//Output a line of the file until the end is reached
		while(!feof($file)) {
			$txt.= str_replace('[NAME]',ucfirst($name),fgets($file)). "\n";
		}
		fclose($file);
		Tools::ch_mod755(MAILBODY_NEWORDER);
		return $txt;
	}
	public static function getMailBodyContact($name, $coment){
		$txt="";
		Tools::ch_mod777(MAILBODY_CONTACT);
		$file = fopen(MAILBODY_CONTACT, "r") or exit("Error al abrir contact.txt!");
		//Output a line of the file until the end is reached
		while(!feof($file)) {
			$txt.= str_replace('[COMENT]',ucfirst($coment),str_replace('[NAME]',ucfirst($name),fgets($file))). "\n";
		}
		fclose($file);
		Tools::ch_mod755(MAILBODY_CONTACT);
		return $txt;
	}
}
?>