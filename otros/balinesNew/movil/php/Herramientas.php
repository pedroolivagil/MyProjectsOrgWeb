<?php
class Herramientas{
	
	function crearDirs($var){
		if(is_dir($var)){
			chmod($var,0744);
		}else{
			mkdir($var,0744);
		}
	}
	
	function limpiarNombre($var,$op=true){
		 return quitarPuntos(reemplazarForm(replace_tildes($var)),$op);
	}
	
	function crearIdUnico($var){
		return 'balinescoleccion_'.substr(md5(microtime()),0,10).'_'.$var;
	}
	
	private function reemplazarForm($var){
		return trim(str_replace('Ñ','_N_',str_replace('ñ','_n_',str_replace(' ','_',$var))));
	}
	
	private function replace_tildes($var){
		$vocales_html=array('à','á','è','é','í','ò','ó','ú','À','Á','È','É','Í','Ò','Ó','Ú');
		$vocales=array('a','a','e','e','i','o','o','u','A','A','E','E','I','O','O','U');
		return trim(str_replace($vocales_html,$vocales,$var));
	}
	
	private function quitarPuntos($var,$op=true){
		if($op){
			$char=array(',','.',';',':','-','/','+','-','*','<','>','º','ª','\\','&','!','"','·','$','%','(',')','=','\'','?','¡','¿','|','@','#','~','€','¬','{','}','[',']','ç','`','´');
			$char_rpl=array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
		}else{
			$char=array('<','>','º','ª','\\','&','"','·','$','%','=','\'','|','@','#','~','€','¬','{','}','[',']','ç');
			$char_rpl=array('','','','','','','','','','','','','','','','','','','','','','');
		}
		return str_replace($char,$char_rpl,$var);
	}
}
?>