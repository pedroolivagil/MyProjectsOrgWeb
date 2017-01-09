<?php
# Administra los productos de la web.
# Crea, elimina o modifica un producto en la base de datos.
# Selecciona un producto según su ID y obten sus datos

class Service {
	private $id;
	private $fee;
	private $descript;
	private $attrs;
	private $category;
	private $permanency;
	private $period;
	private $feeHigh;
	private $penalty;
	private $subservices;

	public function __construct($id = NULL){
		if($id){$this->select($id);}
	}
	public static function getAllServices(){
		$sql = Tools::getDB()->query('SELECT * FROM service');
		return Tools::fillArray($sql);
	}
	public static function add($idCategory, $descript, $fee, $period = 'mensual', $permanency = 0, $feeHigh = 0, $penalty = 0){
		$sql = Tools::getDB()->query('SELECT id_service FROM service WHERE description LIKE "'.$descript.'"');
		if(!($res = $sql->fetch_row())){
			Tools::getDB()->query('INSERT INTO service(description,fee,period,permanency,fee_high,penalty) VALUES("'.$descript.'",'.$fee.',"'.$period.'",'.$permanency.','.$feeHigh.','.$penalty.')');	
			Tools::getDB()->query('INSERT INTO rel_service_category(id_service,id_cat) VALUES((SELECT id_service FROM service WHERE description LIKE "'.$descript.'"),'.$idCategory.')');
		}
	}
	public static function del($id = NULL){
		if(Tools::isEmpty($id)){
			$id = $this->id;
		}
		Tools::getDB()->query('DELETE FROM service WHERE id_service = '.$id);
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
		Tools::getDB()->query('UPDATE service SET '.$str.' WHERE id_service = '.$id);	
	}
	public static function getLastContractID(){
		//$sql = Tools::getDB()->query('SELECT MAX(id_contratacion) FROM rel_client_service');
		$sql = Tools::getDB()->query("SHOW TABLE STATUS LIKE 'rel_client_service'");
		if($res = $sql->fetch_array()){
			return $res['Auto_increment'];
		}
		return false;
	}
	public function isProduct($id){
		$sql = Tools::getDB()->query('SELECT * FROM service WHERE id_service = '.$id);
		if($res = $sql->fetch_array()){
			return true;
		}
		return false;
	}
	public function select($id){
		if($this->isProduct($id)){			
			$sql = Tools::getDB()->query('SELECT * FROM service WHERE id_service = '.$id);
			if($res = $sql->fetch_array()){
				$this->id = $res['id_service'];
				$this->fee = $res['service_fee'];
				$this->descript = $res['description'];
				$this->permanency = $res['permanency'];
				$this->period = $res['period'];
				$this->feeHigh = $res['entry_fee'];
				$this->penalty = $res['penalty'];
				
				$sql_cat = Tools::getDB()->query('SELECT id_cat FROM rel_service_category WHERE id_service = '.$res['id_service']);
				$cat = $sql_cat->fetch_row();
				$this->category = $cat[0];
				
				$sql_sub = Tools::getDB()->query('SELECT * FROM rel_service_subservice WHERE id_service = '.$res['id_service']);
				$sub = Tools::fillArray($sql_sub);
				$this->subservices = array();
				foreach($sub as $val){
					$sql_sub = Tools::getDB()->query('SELECT * FROM sub_service WHERE id = '.$val['id_subservice']);
					if($res_sub = $sql_sub->fetch_array()){
						array_push($this->subservices, $res_sub);
					}
				}
			}
			return true;
		}
		return false;
	}
	public function getID(){
		// devuelve el id
		return $this->id;
	}
	public function getFee(){
		// devuelve la cuota mensual
		return $this->fee;
	}
	public function getDescript(){
		// devuelve la descripcion del producto
		return $this->descript;
	}
	public function getCategory(){
		// devuelve el ID de la categoría a la que pertenece el servicio
		return $this->category;
	}
	public function getPermanency(){
		// devuelve los meses de permanencia
		return $this->permanency;
	}
	public function getPeriod(){
		// devuelve el periodo de facturación
		return $this->period;
	}
	public function getFeeHigh(){
		// devuelve la cuota de alta
		return $this->feeHigh;
	}
	public function getPenalty(){
		// devuelve la penalización
		return $this->penalty;
	}
	public function getSubservices(){
		// devuelve un array con los servicios incluidos
		return $this->subservices;
	}
}
?>