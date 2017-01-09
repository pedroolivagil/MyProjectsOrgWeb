<?php
# Administra las categorias de la web.
# Crea, elimina o modifica una categoria en la base de datos.
# Selecciona una categoria según su ID y obten sus datos

class Category {
	private $id;
	private $descript;
	private $link;
	private $pdf_url;
	
	public function __construct($id){
		$this->select($id);
	}
	public static function add($descript){
		$sql = Tools::getDB()->query('SELECT id FROM category WHERE description LIKE "'.$descript.'"');
		if(!($res = $sql->fetch_row())){
			Tools::getDB()->query('INSERT INTO category(description) VALUES("'.$descript.'")');	
		}
	}
	public static function del($id = NULL){
		if(Tools::isEmpty($id)){
			$id = $this->id;
		}
		Tools::getDB()->query('DELETE FROM category WHERE id = '.$id.' LIMIT 1');	
	}
	public static function update($arr, $id = NULL){		
		if(Tools::isEmpty($id)){
			$id = $this->id;
		}
		$x=0;
		foreach($arr as $key => $val){
			$str.=$key.' = "'.$val.'"';
			if($x < count($arr)){
				$str.',';
			}
			$x++;
		}
		Tools::getDB()->query('UPDATE category SET '.$str.' WHERE id = '.$id);		
	}
	public function select($id = NULL){
		if(Tools::isEmpty($id)){
			$id = $this->id;
		}
		if(!Tools::isEmpty($id)){
			$sql = Tools::getDB()->query('SELECT * FROM category WHERE id = '.$id);
			if($res = $sql->fetch_array()){
				$this->id = $res['id'];
				$this->descript = $res['description'];
				$this->link = $res['link'];
				$this->pdf_url = $res['pdf_url'];
			}
		}		
	}
	public static function getLastID(){
		$sql = Tools::getDB()->query('SELECT MAX(id) FROM category');
		if($res = $sql->fetch_row()){
			return $res[0];
		}
	}
	private function checkID($id){		
		if(Tools::isEmpty($id)){
			$id = $this->id;
		}
	}
	public function getID(){
		return $this->id;
	}
	public function getDescript(){
		return $this->descript;
	}
	public function getLink(){
		return $this->link;
	}
	public function getPdfUrl(){
		return $this->pdf_url;
	}
}
?>