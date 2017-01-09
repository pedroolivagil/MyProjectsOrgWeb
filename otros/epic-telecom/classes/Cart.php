<?php
class Cart {
	private $id_service;			// servicio seleccionado
	private $id_subservices;		// Array de subservicios NO incluidos en el servicio
	private $total;
	private $total_entry;
	
	public function __construct($id_service = NULL){
		$this->id_service = $id_service;
		$this->id_subservices = array();
		$this->total = 0;
		$this->total_entry = 0;
	}
	
	public function add_service($id_service){
		// añade un servicio al carrito
		$this->id_service = $id_service;
		$this->del_allsubservices();
		// $this->save();  // ya se esta usando en del_allsubservices()
	}
	public function add_subservice($id_subservice){
		// añade un subservicio al carrito
		$x = new Service($this->getService());
		switch($x->getCategory()){
			case 1:
				$this->id_subservices = array();
				array_push($this->id_subservices, $id_subservice);
			break;
			case 2:	case 3:	case 4:
				array_push($this->id_subservices, $id_subservice);
			break;
		}
		//array_push($this->id_subservices, $id_subservice);
		$this->save();
	}
	public function del_service($id_service){
		// elimina un servicio del carrito
		$this->unset_cart();
	}
	public function del_subservice($id_service){
		// elimina un subservicio del carrito
		$key = array_search($id_service, $this->id_subservices);
		array_splice($this->id_subservices,$key,1);
		$this->save();
	}
	public function del_allsubservices(){
		// elimina un subservicio del carrito
		$this->id_subservices = array();
		$this->save();
	}
	public function unset_cart(){
		// vacía el carrito de la compra
		$this->id_service = NULL;
		$this->id_subservices = array();
		$this->total = 0;
		$this->total_entry = 0;
		unset($_SESSION['form']);
		$this->save();
	}	
	public function isEmpty(){
		// devuelve TRUE si no hay servicio en el carrito
		return Tools::isEmpty($this->id_service);
	}
	public function getService(){
		// devuelve el servicio
		return $this->id_service;
	}
	public function getSubServices(){
		// devuelve el array de servicios
		sort($this->id_subservices);
		$x = new Service($this->getService());
		switch($x->getCategory()){
			case 2:
				return $this->id_subservices;
			break;
			case 1: case 3: case 4:
				return array_unique($this->id_subservices);
			break;
		}
	}
	public function setTotal($total){
		$this->total = $total;
		$this->save();
	}
	public function setTotalEntry($total_entry){
		$this->total_entry = $total_entry;
		$this->save();
	}
	public function addTotal($total){
		$this->total+= $total;
		$this->save();
	}
	public function addTotalEntry($total_entry){
		$this->total_entry+= $total_entry;
		$this->save();
	}
	public function getTotal(){
		return $this->total;
	}
	public function getTotalEntry(){
		return $this->total_entry;
	}
	public function save(){
		// sobreescribimos la cookie
		Tools::setCart($this);
		//usleep(10000);
	}
}
?>