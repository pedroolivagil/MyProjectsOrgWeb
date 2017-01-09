<?php
# Administra los lenguajes mediante los métodos.
# Todos los lenguajes están disponibles en la carpeta locale.
# Lenguajes: 
# 	- Español
# 	- Catalán (Prox.)
# El método getString($key), devuelve una cadena de strings según $key
	
class Locale {
	private $l;
	private $lang;
	
	public function __construct($lang = 'es'){
		// añadimos el idioma a la variable para usar despues como referencia
		$this->lang = $lang;
		// leemos el fichero del idioma segun el escogido.
		if(file_exists(_CLASS_PATH_.'locale/'.$lang.'.json')){
			$this->l = json_decode(file_get_contents(_CLASS_PATH_.'locale/'.$lang.'.json'), FILE_USE_INCLUDE_PATH);
		}else{
			$this->l = json_decode(file_get_contents(_CLASS_PATH_.'locale/es.json'), FILE_USE_INCLUDE_PATH);
		}
	}
	public function getString($key){
		return $this->l[$key];
	}
}
?>