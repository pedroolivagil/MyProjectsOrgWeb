<?php
# Administra los productos de la web.
# Crea, elimina o modifica un producto en la base de datos.
# Selecciona un producto según su ID y obten sus datos

class SubService {
	private $id;
	private $code_service;
	private $fee;
	private $period;
	private $permanency;
	private $entry_fee;
	private $penalty;
	private $available;
	private $attr1;
	private $attr2;
	private $attr3;
	private $attr4;
	private $atributes;

	public function __construct($id = NULL){
		if($id){$this->select($id);}
	}
	public static function add(){
		$sql = Tools::getDB()->query(''); // comprobar que no exista ya ese subservicio
		if(!($res = $sql->fetch_row())){
			Tools::getDB()->query(''); // insertar en tabla se subservice
			Tools::getDB()->query(''); // si esta relacionado con algun servicio, introducirlo en rel_serv_subserv
		}
	}
	public static function del($id = NULL){
		if(Tools::isEmpty($id)){
			$id = $this->id;
		}
		Tools::getDB()->query('DELETE FROM sub_service WHERE id = '.$id);
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
		Tools::getDB()->query('UPDATE sub_service SET '.$str.' WHERE id = '.$id);	
	}
	public function isService($id){
		if($sql = Tools::getDB()->query('SELECT * FROM sub_service WHERE id = '.$id)){
			if($res = $sql->fetch_array()){
				return true;
			}
			return false;
		}else{
			return false;
		}
	}
	public function select($id){
		if($this->isService($id)){			
			$sql = Tools::getDB()->query('SELECT * FROM sub_service WHERE id = '.$id);
			if($res = $sql->fetch_array()){
				$this->id = $res['id'];
				$this->code_service = $res['code_service'];
				$this->available = $res['available'];
				$this->fee = $res['fee'];
				$this->period = $res['period'];
				$this->permanency = $res['permanency'];
				$this->entry_fee = $res['entry_fee'];
				$this->penalty = $res['penalty'];
				$this->attr1 = $res['attr1'];
				$this->attr2 = $res['attr2'];
				$this->attr3 = $res['attr3'];
				$this->attr4 = $res['attr4'];
				
				$this->atributes = Tools::getDB()->query('SELECT * FROM attributes_service WHERE code_service LIKE "'.$this->code_service.'"');
			}
			return true;
		}
		return false;
	}	
	public function selectByCodeService($str){
		$sql = Tools::getDB()->query('SELECT id FROM sub_service WHERE code_service LIKE "'.$str.'"');	
		if($res = $sql->fetch_row()){
			$this->select($res[0]);
		}
	}
	public function getID(){
		// devuelve el id
		return $this->id;
	}
	public function getCodeService(){
		// devuelve la cuota mensual
		return $this->code_service;
	}
	public function getDescript(){
		// devuelve la descripcion del servicio
		if($res = $this->atributes->fetch_array()){
			return $res['description'];
		}
		return false;
	}
	public function getAvailable(){
		// devuelve los ids de las categorias a la que el servicio esta disponible
		return explode(',',$this->available);
	}
	public function getFee(){
		// devuelve la cuota mensual
		return $this->fee;
	}
	public function getPeriod(){
		// devuelve el periodo de facturación
		return $this->period;
	}
	public function getPermanency(){
		// devuelve los meses de permanencia
		return $this->permanency;
	}
	public function getEntryFee(){
		// devuelve la cuota mensual
		return $this->entry_fee;
	}
	public function getPenalty(){
		// devuelve la penalización
		return $this->penalty;
	}
	public function getAttr1(){
		// devuelve la cuota mensual
		return $this->attr1;
	}
	public function getAttr2(){
		// devuelve la cuota mensual
		return $this->attr2;
	}
	public function getAttr3(){
		// devuelve la cuota mensual
		return $this->attr3;
	}
	public function getAttr4(){
		// devuelve la cuota mensual
		return $this->attr4;
	}
}
?>