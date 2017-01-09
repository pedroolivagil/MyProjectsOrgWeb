<?php
include_once('funciones.php');
require_once('thumb.php');
/**
 * Clase para subir y borrar archivos
 * @uses Instanciar la clase con los datos de la variable $_FILE más los adicionales
 *       no incluidos en esta variable global.
 * @param String    $archivo            Archivo a manipular
 * @param String    $directorio         Directorio de destino del archivo 
 * @param String    $tipoArchivo        Extensión que identifica el nombre del archivo
 * @param Array     $tipoPermitido     	Arreglo con las extensiones permitidas
 * @param int       $tamanoArchivo      Tamaño del archivo (en bytes)
 * @param String    $tmp                Directorio temporal de localización del archivo
 * @param String    $nombre             Nombre del archivo a manipular
 * @param int       $tamanoMaximo       Máximo tamaño aceptado 
 *
 * @author Jorge Andrade M.
 */
echo '<link rel="stylesheet" type="text/css" href="../../css/fonts.css">';
echo "<style>.iframe {font-family:'agency_fbregular'; font-size:1.4em;}</style>";
class uploadclass{	
	var $archivo;
	var $directorio;	
	var $tipoArchivo;
	var $tipoPermitido;
	var $tamanoArchivo;
	var $tmp;
	var $nombre;
	var $tamanoMaximo;	
	var $sql;
	var $img,$ruta2,$tipo,$tam;
	var $style=array('<span class="iframe">','</span>');
	/**
	 * Constructor de la clase Archivo
	 *
	 * @param string $archivo
	 * @param string $dir	 
	 * @param array $extPermitida
	 * @param int $tamano
	 * @param string $tmp
	 * @param string $nombre
	 * @param int $tamPermitido	 
	 */
	public function __construct($archivo,$dir,$extPermitida=array(),$tamano,$tipo,$tmp,$nombre='',$tamPermitido='',$sql){
		$this->archivo			= $archivo;
		$this->directorio		= $dir;		
		$this->tipoArchivo		= $this->getTipoArchivo($archivo,$tipo);
		$this->tipoPermitido	= $extPermitida;
		$this->tamanoArchivo	= $tamano;		
		$this->nombre			= empty($nombre) ? str_replace(".".$this->tipoArchivo,"",$archivo) : $nombre;		
		$this->tamanoMaximo		= empty($tamPermitido) ? ini_get('upload_max_filesize')*1048576 : $tamPermitido*1048576;
		$this->tmp				= $tmp;
		$this->sql				= $sql;
	}
	
	/**
	 * Devuelve la extensión de un archivo
	 * @param String $archivo Cadena con el nombre original del archivo
	 * @return String $extension
     * @author Jorge Andrade M.
	 */
	private function getTipoArchivo($archivo,$tipo){
		if($archivo!=''){
			/*$extension=end(explode('.',$archivo));*/
			$extension=str_replace('jpeg','jpg',str_replace('image/','',$tipo));
			return $extension;
		}
	}
	/**
	 * Revisa si el tipo del archivo está dentro de lo permitido
	 * @return boolean Si cumple o no con lo establecido
     * @author Jorge Andrade M.
	 */
	private function checkType(){
		if(in_array($this->tipoArchivo,$this->tipoPermitido)){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * Revisa si el archivo es del tamaño permitido
	 * @return boolean Si cumple o no con lo establecido
     * @author Jorge Andrade M.
	 */
	private function checkSize(){
		if($this->tamanoArchivo > $this->tamanoMaximo){
			return false;
		}else{
			return true;
		}
	}	
	/**
	 * Sube los archivos, revisa si no sobrepasa el tamaño máximo permitido,
	 *  si está dentro de los tipos aceptados y si no exite
	 *
	 * @return boolean indicando el resultado del proceso
	 */
	public function upLoadFile(){
		if($this->checkSize()==false){
			echo $this->style[0]."El tamano del archivo sobrepasa el permitido que es de ".round(($this->tamanoMaximo/1048576),2)."MB".$this->style[1];
			return false;
		}
		if($this->checkType()==false){
			echo $this->style[0]."El archivo no corresponde a un formato permitido. Los permitidos son: ".(implode(",",$this->tipoPermitido)).$this->style[1];
			return false;
		}
		if(file_exists($this->directorio.$this->archivo)){
			echo $this->style[0]."El archivo ya existe".$this->style[1];
			return false;		
		}
		$count=0;
		if(move_uploaded_file($this->tmp,$this->directorio.$this->nombre.".".$this->tipoArchivo)){
			$count++;
			$thumbnail = new thumb();
			$thumbnail->loadImage($this->directorio.$this->nombre.".".$this->tipoArchivo);
			$thumbnail->resize(100,'width');
			$thumbnail->crop(100,100);
			$thumbnail->save($this->directorio.'thumb/'.$this->nombre.".".$this->tipoArchivo);
		}else{
			return false;
		}
		if(sqlQuery($this->sql)){
			$count++;
		}else{
			$this->delFile();
			return false;
		}
		if($count==2){
			echo $this->style[0].'Imagen colocada y registro finalizado'.$this->style[1];
		}else{
			echo $this->style[0].'Se produjeron algunos errores'.$this->style[1];
		}
		return true;
	}
	/**
	 * Borra el archivo del servidor
	 *
	 * @return boolean
	 */
	public function delFile(){
		if(file_exists($this->directorio.$this->archivo)){
			unlink($this->directorio.$this->archivo);
			return true;
		}else{
			return false;
		}		
	}
}
?>