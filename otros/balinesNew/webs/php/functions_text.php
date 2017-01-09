<?php
$charsDel=array(',','.',';',':','-','/','+','-','*','<','>','º','ª','\\','&','!','"','·','$','%','(',')','=','\'','?','¡','¿','|','@','#','~','€','¬','{','}','[',']');
$meses_login=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
function replace($var){
	$vocales=array('à','á','è','é','í','ò','ó','ú','À','È','É','Í','Ò','Ó','Ú','Ñ','ñ');
	$vocales_html=array('&agrave;','&aacute;','&egrave;','&eacute;','&iacute;','&ograve;','&oacute;','&uacute;','&Agrave;','&Egrave;','&Eacute;','&Iacute;','&Ograve;','&Oacute;','&Uacute;','&Ntilde;','&ntilde;');
	$frase=trim((str_replace($vocales,$vocales_html,($var))));
	return $frase;
}
function reemplazarForm($var){
	$variable=trim(str_replace('Ñ','_N_',str_replace('ñ','_n_',str_replace(' ','_',$var))));
	return $variable;
}
function replace_tildes($var){
	$vocales_html=array('à','á','è','é','í','ò','ó','ú','À','Á','È','É','Í','Ò','Ó','Ú');
	$vocales=array('a','a','e','e','i','o','o','u','A','A','E','E','I','O','O','U');
	$frase=trim((str_replace($vocales_html,$vocales,($var))));	
	return $frase;
}
function quitarPuntos($var){
	$char=array(',','.',';',':','-','/','+','-','*','<','>','º','ª','\\','&','!','"','·','$','%','(',')','=','\'','?','¡','¿','|','@','#','~','€','¬','{','}','[',']','ç','`','´');
	$char_rpl=array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
	$variable=str_replace($char,$char_rpl,$var);
	return $variable;
}
function quitarPuntos2($var){
	$char=array(',',';',':','/','+','*','<','>','º','ª','\\','&','!','"','·','$','%','(',')','=','\'','?','¡','¿','|','@','#','~','€','¬','{','}','[',']','ç');
	$char_rpl=array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
	$variable=str_replace($char,$char_rpl,$var);
	return $variable;
}
function quitarPuntos3($var){
	$char=array('<','>','º','ª','\\','&','"','·','$','%','=','\'','|','@','#','~','€','¬','{','}','[',']','ç');
	$char_rpl=array('','','','','','','','','','','','','','','','','','','','','','');
	$variable=str_replace($char,$char_rpl,$var);
	return $variable;
}
function replaceInverse($var){
	$variable=str_replace('%C3%B1','ñ',str_replace('_',' ',str_replace('_N_','Ñ',str_replace('_n_','ñ',trim($var)))));
	return $variable;
}
function dejarPunto($var){
	$char=array(',',';',':','/','+','*','<','>','º','ª','\\','&','!','"','·','$','%','(',')','=','\'','?','¡','¿','|','@','#','~','€','¬','{','}','[',']','ç');
	$char_rpl=array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
	$variable=str_replace($char,$char_rpl,$var);
	return $variable;
}
function limitarSalida($var,$limite){
	$longWeight=strlen($var);
	if($longWeight>$limite){
		$frase=substr($var,0,$limite).'...';
	}else{
		$frase=$var;
	}
	return $frase;
}
function defaultValue($var){
	if(is_numeric($var)){
		$frase=$var;
	}elseif(!$var or $var==NULL or !isset($var)){
		$frase='Campo vacío';
	}else{
		$frase=$var;
	}
	return $frase;
}
?>