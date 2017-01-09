<?php
# Administra los clientes de la web.
# Crea, elimina o modifica un cliente en la base de datos.
# Selecciona un cliente según su Nif y obten sus datos
# debe pasarse un nif para obtener los datos del cliente, si no se le pasa no se puede acceder a sus datos

class Client {
	private $id;
	private $username;
	private $nif;
	private $email;
	private $pwd;
	private $name;
	private $signUp;
	private $phone;
	private $errormsg;
	
	public function __construct($nif = NULL){
		Tools::init('es');
		// si $nif es pasado, se comprobara que existe en la base de datos y se seleccionará
		if(!Tools::isEmpty($nif)){
			if($this->isUser($nif)){
				$this->selectUser($nif);
			}
		}
	}
	public static function isLogged(){
		// devuelve true si la sesion esta iniciada
		return (!Tools::isEmpty($_SESSION['id_session']));
	}
	public function logout(){
		session_unset();
		Log::newLog('Log Out',Tools::getLocale()->getString('LOGIN_USER_SUCCESS'), $this->nif);
	}
	public static function del($nif){
		// borramos un usuario de la base de datos
		if(Tools::getDB()->query('DELETE FROM client WHERE user_nif LIKE "'.$nif.'" LIMIT 1')){
			Log::newLog('Delete User',Tools::getLocale()->getString('DELETE_USER_ACCOUNT'),$nif);
		}
	}
	public function generatepwd(){
		// genera un array con el password encriptado y sin.
		$pass = Tools::uniqID(16);
		return array($pass, Tools::cryptString($pass));
	}
	public function add($nif, $businessName, $mail, $fullname, $phone = NULL, $birth = NULL){
		// añadimos un usuario a la base de datos
		$nif = strtoupper($nif);
		if(!Tools::isEmpty($nif)){
			if(!$this->isUser($nif)){
				if(!Tools::isEmpty($fullname) && !Tools::isEmpty($mail) && !Tools::isEmpty($businessName)){
					/*$pass = Tools::uniqID(16);
					$passC = Tools::cryptString($pass);*/
					$pass = $this->generatepwd();
					$mailC = Tools::cryptString($mail);
					if(Tools::getDB()->query('INSERT INTO client(user_name, user_pass, user_mail, user_fullname, user_phone, user_birth, user_nif, user_local, id_mail) VALUES("'.$businessName.'","'.$pass[1].'","'.$mail.'","'.$fullname.'","'.$phone.'","'.$birth.'","'.$nif.'","España","'.$mailC.'")')){
						Log::newLog('Sign Up',Tools::getLocale()->getString('NEW_USER_SUCCESS'), $nif);
						Tools::newDir(_USER_PATH_);
						Tools::newDir(_USER_PATH_.'/'.$nif);
						Tools::newDir(_USER_PATH_.'/'.$nif.'/files');
						$m = new Mail();
						$m->setTo(array($mail, $fullname),true);
						$m->setBody('New User',Tools::getMailBodyUser($fullname, $nif, $pass[0], $mail));
						$m->send();
						$this->errormsg = 'Registro completo';
						$this->login(false);
						return true;
					}else{$this->errormsg = 'Error al registrar';}
				}else{$this->errormsg = 'Campos vacías';}
			}else{$this->errormsg = 'Ya existe el usuario';}
		}else{$this->errormsg = 'NIF vacio';}
	}
	private function update($arr, $nif = NULL){
		if(Tools::isEmpty($nif)){
			$nif = $this->getNif();
		}
		// actualizamos la base de datos segun el array ($key, $value)
		$x=0;
		foreach($arr as $key => $val){
			$str.=$key.' = "'.$val.'"';
			if($x < count($arr)){
				$str.',';
			}
			$x++;
		}
		if(Tools::getDB()->query('UPDATE client SET '.$str.' WHERE user_nif LIKE "'.$nif.'"')){
			Log::newLog('Update User',Tools::getLocale()->getString('UPDATE_USER_ACCOUNT'), $nif);
			return true;
		}
		return false;
	}
	public function updatePwd($new, $isCrypted = false){
		// actualizamos el password por uno nuevo
		if($this->isUser($this->nif)){
			if(!$isCrypted){
				return $this->update(array('user_pass' => Tools::cryptString($new)));
			}else{
				return $this->update(array('user_pass' => $new));
			}
		}
		return false;
	}
	public function updateName($new){
		// actualizamos el fullname por uno nuevo
		if($this->isUser($this->nif)){
			return $this->update(array('user_fullname' => $new));
		}
		return false;
	}
	public function updateMail($new){
		// actualizamos el email por uno nuevo
		if($this->isUser($this->nif)){
			return $this->update(array('user_mail' => $new));
		}
		return false;
	}
	public function updatePhone($new){
		// actualizamos el telefono por uno nuevo
		if($this->isUser($this->nif)){
			return $this->update(array('user_phone' => $new));
		}
		return false;
	}
	public function isUser($nif){
		// comprobamos si el nif pasado es un usuario de la base de datos
		if($sql = Tools::getDB()->query('SELECT * FROM client WHERE user_nif LIKE "'.$nif.'"')){
			if($res = $sql->fetch_array()){
				if(count($res) > 0){
					return true;
				}else{
					$this->errormsg = 'No existe el usuario';
					return false;
				}
			}else{
				$this->errormsg = 'No existe el usuario';
				return false;
			}
		}
	}
	public function selectUser($nif){
		// seleccionamos un usuario mediante el nif pasado
		$sql = Tools::getDB()->query('SELECT * FROM client WHERE user_nif LIKE "'.$nif.'"');
		if($res = $sql->fetch_array()){
			$this->id = $res['id'];
			$this->username = $res['user_name'];
			$this->nif = $res['user_nif'];
			$this->email = $res['user_mail'];
			$this->pwd = $res['user_pass'];
			$this->name = $res['user_fullname'];
			$this->signUp = $res['user_datereg']; 	
			$this->phone = $res['user_phone']; 	
		}
	}
	public function login($autologin = false){
		// iniciamos session
		if($autologin){
			Tools::setCookie('nif', $this->nif);
		}
		if($this->isUser($this->nif)){
			$_SESSION['id_session'] = Tools::uniqID(20);
			$_SESSION['user_session'] = $this->nif;
			$_SESSION['time_session'] = time();
			Log::newLog('Sign In', Tools::getLocale()->getString('LOGIN_USER_SUCCESS'), $this->nif);
		}
	}
	public function setMessageError($str){
		$this->errormsg = $str;
	}
	public function addService($serv){
		$cart = Tools::getCart();				// recuperamos carrito
		$servicios = $cart->getSubServices();	// recuperamos losservicios del carrito
		$f = $_SESSION['form'];					// recuperamos el formulario de la sesion
		if(!$cart->isEmpty() and Client::isLogged()){			
			// añadimos el servico al cliente
			if(Tools::getDB()->query('INSERT INTO rel_client_service(id_client, id_serv, id_cat, mensual_fee, entry_fee, install_fee) VALUES('.$this->id.','.$serv->getID().','.$serv->getCategory().','.$cart->getTotal().','.$cart->getTotalEntry().',0)')){
			// si el servicio se ha insertado:				
				// insertamos el producto comprado en la tabla de ventas
				Tools::getDB()->query('INSERT INTO client_purchase(id_client, services) VALUES('.$this->id.',"'.$serv->getID().'")');
				
				// consultamos su id
				$sql = Tools::getDB()->query('SELECT id_contratacion FROM rel_client_service WHERE id_client = '.$this->id.' AND id_serv = '.$serv->getID().' AND id_cat = '.$serv->getCategory());
				if($res = $sql->fetch_row()){
					// añadimos los subservicios incluidos en el servicio
					$this->addIncludedSubService($serv, $res[0]);
					// si hay servicios NO INCLUIDOS los insertamos tambien
					if(!Tools::isEmpty($servicios)){
						foreach($servicios as $id){
							$this->addSubService($id, $res[0]);
						}					
					}
					// obtener datos de formulario
					if($serv->getCategory()==1){
						if($f['form_chnladd'] > 0){
							$this->addSubService('(SELECT id FROM sub_service WHERE code_service LIKE "CHADD")', $res[0], $f['form_chnladd']);
				// se puede reemplazar si el carrito ya calcula estos servicios en el total
							Tools::getDB()->query('UPDATE rel_client_service SET mensual_fee = (mensual_fee + ('.$f['form_chnladd'].' * (SELECT fee FROM sub_service WHERE code_service LIKE "CHADD"))) WHERE id_contratacion = '.$res[0]);
						}
						if($f['form_gnumadd'] > 0){
							$this->addSubService('(SELECT id FROM sub_service WHERE code_service LIKE "GNUM")', $res[0], $f['form_gnumadd']);
				// se puede reemplazar si el carrito ya calcula estos servicios en el total
							Tools::getDB()->query('UPDATE rel_client_service SET mensual_fee = (mensual_fee + ('.$f['form_gnumadd'].' * (SELECT fee FROM sub_service WHERE code_service LIKE "GNUM"))) WHERE id_contratacion = '.$res[0]);
						}
						if($f['form_restrictaddicionalnums']){
							$this->addSubService('(SELECT id FROM sub_service WHERE code_service LIKE "RESTRICT_80X90X118XX")', $res[0], $f['form_restrictaddicionalnums']);
						}
						if($f['form_restrictinternational']){
							$this->addSubService('(SELECT id FROM sub_service WHERE code_service LIKE "RESTRICT_INTERN")', $res[0], $f['form_restrictinternational']);
						}
						if($f['form_autorizZonaA']){
							$this->addSubService('(SELECT id FROM sub_service WHERE code_service LIKE "AUTOR_ZONA_A")', $res[0], $f['form_autorizZonaA']);
						}
						if($f['form_autorizinternational']){
							$this->addSubService('(SELECT id FROM sub_service WHERE code_service LIKE "AUTOR_DESTINO")', $res[0], $f['form_autorizinternational_values']);
						}
						if($f['form_gnumport']){
							$this->addSubService('(SELECT id FROM sub_service WHERE code_service LIKE "GNUMPORTAT")', $res[0], $f['form_gnumport_values']);
						}
					}
					// añadimos la dirección del servicio
					$this->addAddress($res[0], $f);
					
					// personalizamos el error en errormsg
					// en caso de fallo en cualquier caso devolvemos error (false)
					return true;
				}else{$this->errormsg = 'Error: No hay registro'; return false;}
			}else{$this->errormsg = 'Error: Puede que ya tenga el servicio contratado.'; return false;}
		}else{$this->errormsg = 'Error: Carrito esta vacío'; return false;}
	}
	/**
	 * @param $serv es de clase Service
	 * @var $subservice un array associativo de servicios
	 */
	private function addIncludedSubService($serv, $id_contract){
		// comprobamos que haya subservicios incluidos
		if(count($serv->getSubservices()) > 0){
			// recorremos para insertarlos
			foreach($serv->getSubservices() as $subservice){
				// usamos la funcion para añadir subservicios
				$this->addSubService($subservice['id'],$id_contract);
			}
		}
	}
	public function addSubService($id_subservice, $id_contract, $value = NULL){
		if(Tools::getDB()->query('INSERT INTO rel_client_subservice(id_contratacion, id_subservice, value_subservice) VALUES('.$id_contract.', '.$id_subservice.',"'.$value.'")')){
		}
	}
	private function addAddress($id_contract, $arr_values){
		// recuperamos los datos del form, guardados en sesion y añadimos la direccion a la BD
		$bill_dir = $arr_values['form_firstdir'].', '.$arr_values['form_firstpob'].', '.$arr_values['form_firstprov'].', '.$arr_values['form_firstcp'];
		Tools::getDB()->query('INSERT INTO service_address(id_contratacion, billing_address, install_address) VALUES('.$id_contract.', "'.$bill_dir.'", "'.$arr_values['form_firstdirinst'].'")');
	}
	public function delSubservice(){
		//'DELETE FROM rel_client_subservice WHERE id_contratacion=  AND id_subservice = ';
	}
	public function getID(){
		return $this->id;
	}
	public function getUserName(){
		return $this->username;
	}
	public function getNif(){
		return $this->nif;
	}
	public function getFullName(){
		return $this->name;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getDataSignUp(){
		return $this->signUp;
	}
	public function getPasswd(){
		return $this->pwd;
	}
	public function getPhone(){
		return $this->phone;
	}
	public function getMessageError(){
		return $this->errormsg;
	}
	public function lastAccess(){
		$sql = Tools::getDB()->query('SELECT * FROM log_user WHERE id_client = '.$this->id.' AND action = (SELECT id FROM log_type WHERE description LIKE "Sign In") ORDER BY timedate DESC LIMIT 1,1');
		return $sql->fetch_array();
	}
	public function getService($id){
		// obtiene el servicio seleccionado por $id del usuario
		$c = 'SELECT rcs.mensual_fee, rcs.date_request, rcs.date_activate, rcs.date_end_service, rcs.visible,s.description,s.service_fee,s.permanency,s.entry_fee FROM rel_client_service rcs, service s WHERE rcs.id_serv = s.id_service AND rcs.id_client = '.$this->getID();
		$sql = Tools::getDB()->query($c);
		return $sql->fetch_array();			
	}
	public function getServices(){
		// obtiene todos los servicios del usuario
		$c = 'SELECT rcs.date_request, rcs.id_contratacion, s.id_service, rcs.mensual_fee, rcs.date_activate, rcs.date_end_service, rcs.visible, s.description, s.service_fee, s.permanency, s.entry_fee FROM rel_client_service rcs, service s WHERE rcs.id_serv = s.id_service AND rcs.id_client = '.$this->getID().' ORDER BY 1 DESC';
		$sql = Tools::getDB()->query($c);
		return Tools::fillArray($sql);
	}
	public function getInvoice($id){
		$sql = Tools::getDB()->query('SELECT i.id_invoice, i.date, i.invoice_url, i.status, s.description AS "descript", rcs.mensual_fee, srv.description FROM invoice i, invoice_status s, rel_client_service rcs, service srv WHERE i.id_contrato = rcs.id_contratacion AND i.status = s.id AND rcs.id_client = i.id_client AND rcs.id_serv = srv.id_service AND i.id_client = '.$this->id.' AND id_invoice = '.$id.' ORDER BY 2 DESC');
		return Tools::fillArray($sql);
	}
	public function getInvoices(){
		$sql = Tools::getDB()->query('SELECT i.id_invoice, i.date, i.invoice_url, i.status, s.description AS "descript", rcs.mensual_fee, srv.description FROM invoice i, invoice_status s, rel_client_service rcs, service srv WHERE i.id_contrato = rcs.id_contratacion AND i.status = s.id AND rcs.id_client = i.id_client AND rcs.id_serv = srv.id_service AND i.id_client = '.$this->id.' ORDER BY 2 DESC, 5 DESC');
		return Tools::fillArray($sql);
	}
	public function getFullService($idcontract){
		// obtiene todos los servicios del usuario
		$c = 'SELECT rcss.*, rcs.id_serv FROM rel_client_subservice rcss, rel_client_service rcs WHERE rcss.id_contratacion = rcs.id_contratacion AND rcs.id_contratacion = '.$idcontract;
		$sql = Tools::getDB()->query($c);
		return Tools::fillArray($sql);
	}
}
?>