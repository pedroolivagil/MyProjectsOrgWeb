<?php
# Crea los logs de usuario para cada acción.

abstract class Log {
	public static function newLog($action, $str, $nif){
		Tools::getDB()->query('INSERT INTO log_user(action,message,id_client,is_good) VALUES((SELECT id FROM log_type WHERE description LIKE "'.$action.'"),"'.$str.'",(SELECT id FROM client WHERE user_nif LIKE "'.$nif.'"),true)');
	}
}
?>