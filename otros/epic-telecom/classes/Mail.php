<?php
# Genera un email y lo envía.

require_once(_CLASS_PATH_.'mail/PHPMailerAutoload.php');
class Mail {
	private $email;
	public function __construct(){
		/* Enviar por email la copia del contrato al usuario y al correo de epic. */	
		$this->email = new PHPMailer();	
		$this->email->IsSMTP(); 							// usamos SMTP
		$this->email->SMTPAuth  = true;                  	// enable SMTP authentication
		$this->email->Host      = "mail.epic.es";			// sets the SMTP server
		$this->email->Username  = "telecom@epic.es"; 		// SMTP account username
		$this->email->Password  = "T3l3c0M158523..";		// SMTP account password
		$this->email->From		= 'telecom@epic.es'; 		// direccion de salida
		$this->email->FromName 	= 'Epic Telecom';			// nombre origen
		$this->email->CharSet 	= 'UTF-8';
		$this->email->isHTML(true);							// Set email format to HTML
	}
	public function setTo($arrTo, $boolBCC = false){
		$this->email->addAddress($arrTo[0], $arrTo[1]);			// correo, nombre destino
		if($boolBCC){
			$this->email->addBCC(MAILTECNIC);					// copia oculta		
		}
	}
	public function setBody($subj, $body){
		$this->email->Subject = $subj;
		$this->email->Body = $body;								// cuerpo de mail
	}
	public function addAttachment($url){
		$this->email->addAttachment($url);				// adjuntamos el pdf
	}
	public function send(){
		if(!$this->email->send()){
			echo '<br />'.$this->email->ErrorInfo;
			return false;
		}
		return true;
	}
	public function clear(){
		$this->email->clearAttachments();
	}
}
?>