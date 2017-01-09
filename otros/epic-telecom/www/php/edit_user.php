<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');
// Formularios para editar el usuario
require_once('../../classes/Tools.php');
require_once('../../classes/Log.php');
require_once('../../classes/Template.php');
require_once('../../classes/Mail.php');
require_once('../../classes/Client.php');
require_once('../../classes/Category.php');
require_once('../../classes/Service.php');
require_once('../../classes/SubService.php');
require_once('../../classes/Cart.php');
//
// Para el password se debera comprobar: 
//	- Que coincida la password insertada con la DB
//	- Que tenga mínimo 7 chars
//	- Que los dos passwords introducidos sean iguales
//	- Que no sea igual a la DB
//
// Para el email:
//	- Validar password para realizar la accion
//	//- Que sea correcto (HTML5 ya lo valida, pero por si acaso)
//	- Que los dos emails introducidos sean iguales
//	- Que no sea igual a la DB
//
// Para el nombre
//	- Validar password para realizar la accion
//	//- Comprobar que no haya números
//	- Tenga un largo máximo de 255 chars
//	- Que los dos nombres introducidos sean iguales
//	- Que no sea igual a la DB
//
// Para el telefono
//	- Validar password para realizar la accion
//	- Verificar que sea un telefono correcto
//	- Que los dos telefonos introducidos sean iguales
//	- Que no sea igual a la DB
if(Client::isLogged()){
	$cl = new Client($_SESSION['user_session']);
	$old = $_REQUEST['old'];
	$new = $_REQUEST['new'];
	$new2 = $_REQUEST['new2'];
	$type = $_REQUEST['type'];
	$t = 'danger';
	switch($type){
		case "pass":
			if($cl->getPasswd() == Tools::cryptString($old)){
				if($old != $new){
					if($new == $new2){
						if(strlen($new) > 6){
							// todo ok
							if($cl->updatePwd($new)){
								$str = Tools::getLocale()->getString('CLIENTAREA_BADPASS_SUCCESS');
								$t = 'success';
							}else{
								// Error en la bd
								$str = Tools::getLocale()->getString('CLIENTAREA_CRITICAL_FAIL');
							}
						}else{
							// en inferior a 7 chars
							$str = Tools::getLocale()->getString('CLIENTAREA_BADPASS_MINCHAR');
						}
					}else{
						// los nuevos no coinciden entre ellos
						$str = Tools::getLocale()->getString('CLIENTAREA_BADPASS_NOEQUAL');
					}
				}else{
					// el viejo y el nuevo son iguales
					$str = Tools::getLocale()->getString('CLIENTAREA_BADPASS_IDENTIC');
				}
			}else{
				// si el pasword viejo no es el mismo que la base de datos
				$str = Tools::getLocale()->getString('CLIENTAREA_BADPASS_WRONGPW');
			}
		break; 
		case "email":
			if($cl->getPasswd() == Tools::cryptString($old)){
				if($new == $new2){
					if($new != $cl->getEmail()){
						if($cl->updateMail($new)){
							$str = Tools::getLocale()->getString('CLIENTAREA_BADMAIL_SUCCESS');
							$t = 'success';
						}else{
							// Error en la bd
							$str = Tools::getLocale()->getString('CLIENTAREA_CRITICAL_FAIL');
						}
					}else{
						// el viejo y el nuevo son iguales
						$str = Tools::getLocale()->getString('CLIENTAREA_BADMAIL_IDENTIC');
					}
				}else{
					// los nuevos no coinciden entre ellos
					$str = Tools::getLocale()->getString('CLIENTAREA_BADMAIL_NOEQUAL');
				}				
			}else{
				// si el pasword viejo no es el mismo que la base de datos
				$str = Tools::getLocale()->getString('CLIENTAREA_BADPASS_WRONGPW');
			}		
		break; 
		case "name":
			if($cl->getPasswd() == Tools::cryptString($old)){
				if($new == $new2){
					if(strlen($new) < 256){
						if($new != $cl->getFullName()){
							if($cl->updateName($new)){
								$str = Tools::getLocale()->getString('CLIENTAREA_BADNAME_SUCCESS');
								$t = 'success';
							}else{
								// Error en la bd
								$str = Tools::getLocale()->getString('CLIENTAREA_CRITICAL_FAIL');
							}
						}else{
							// el viejo y el nuevo son iguales
							$str = Tools::getLocale()->getString('CLIENTAREA_BADNAME_IDENTIC');
						}
					}else{
						// el viejo y el nuevo son iguales
						$str = Tools::getLocale()->getString('CLIENTAREA_BADNAME_MAX256');
					}
				}else{
					// los nuevos no coinciden entre ellos
					$str = Tools::getLocale()->getString('CLIENTAREA_BADNAME_NOEQUAL');
				}				
			}else{
				// si el pasword viejo no es el mismo que la base de datos
				$str = Tools::getLocale()->getString('CLIENTAREA_BADPASS_WRONGPW');
			}	
		break;
		case "phone":
			if($cl->getPasswd() == Tools::cryptString($old)){
				if($new == $new2){
					if(Tools::isPhone($new)){
						if($new != $cl->getPhone()){
							if($cl->updatePhone($new)){
								$str = Tools::getLocale()->getString('CLIENTAREA_BADPHON_SUCCESS');
								$t = 'success';
							}else{
								// Error en la bd
								$str = Tools::getLocale()->getString('CLIENTAREA_CRITICAL_FAIL');
							}
						}else{
							// el viejo y el nuevo son iguales
							$str = Tools::getLocale()->getString('CLIENTAREA_BADPHON_IDENTIC');
						}
					}else{
						// el viejo y el nuevo son iguales
						$str = Tools::getLocale()->getString('CLIENTAREA_BADPHON_MALFORM');
					}
				}else{
					// los nuevos no coinciden entre ellos
					$str = Tools::getLocale()->getString('CLIENTAREA_BADPHON_NOEQUAL');
				}				
			}else{
				// si el pasword viejo no es el mismo que la base de datos
				$str = Tools::getLocale()->getString('CLIENTAREA_BADPASS_WRONGPW');
			}	
		break;  
	} // switch
	header('Location: '._ROOT_PATH_.'perfil/'.urlencode(base64_encode($str)).'/'.urlencode(base64_encode($t)));
}else{
	header('Location: '._ROOT_PATH_.'first-login');
}
?>