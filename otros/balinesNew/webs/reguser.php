<?php
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../foro/'; // Cambiar ./foro por la ruta de tu foro
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
require($phpbb_root_path . 'includes/functions_user.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();
$sms='<div style="position:relative; margin:5px; left:3%; padding-top:50px;">';
// Archivo necesario para el registro
// Start session management
// Si el usuario ya se encuentra registrado e idenficado le mustra un aviso en vez del formulario de registro
if ($user->data['is_registered'] || isset($_REQUEST['not_agreed'])) {
	exit($user->data['username'] . ' ya te encuentras registrado.');
}

// Si envia el formulario empieza con el proceso.
$register = request_var('register', '');
if ($register) {

	//Buscamos cual es el grupo por defecto
	$coppa = (isset($_REQUEST['coppa'])) ? ((!empty($_REQUEST['coppa'])) ? 1 : 0) : false;
	$group_name = ($coppa) ? 'REGISTERED_COPPA' : 'REGISTERED';
	$sql = 'SELECT group_id
		FROM ' . GROUPS_TABLE . "
		WHERE group_name = '" . $db->sql_escape($group_name) . "'
			AND group_type = " . GROUP_SPECIAL;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$group_id = $row['group_id'];
	
	// Tomamos los valores del formulario.
	$username = request_var('usuario', '');
	$email = request_var('email', '');
	$password = phpbb_hash(request_var('password', '', true));
	$password_confirm = phpbb_hash(request_var('password', '', true));

	// Pasamos todos lo datos de registro a un vector.
	$user_row = array(
		'username' => $username,
		'user_email' => $email,
		'user_password' => $password,
		'group_id' => $group_id,
		'user_type' => '0',
		'user_new' => 1, // Entrara al grupo de nuevos usuarios registrados.
	);

	$query = 'SELECT username, user_email
		FROM ' . USERS_TABLE . '
		WHERE username = "' . $username . '"
			OR user_email = "' . $email . '"';
	$res = $db->sql_query($query);

	// Verificamos que el usuario no exista y que las contraseñas sean iguales.
	if ($db->sql_fetchrow($res) || (request_var('password', '', true) != request_var('password', '', true))) {
		$sms.='<span class="idenUserFail">El nombre de usuario o email ya se encuentran registrados o las contraseñas no concuerdan.</span><br /><br />';
	} else {
		// La funcion user_add() del /includes/functions_user.php se encarga del resto.
		user_add($user_row);
		$sms.='<span class="idenUserOk">Tu cuenta en el foro ha sido creada.</span><br /><br />';
	}
}
include_once('php/funciones.php');
include_once('php/functions_text.php');
$user=strtolower(reemplazarForm(quitarPuntos2($_POST['usuario'])));
$pass=cryptPass($_POST['password']);
$mail=$_POST['email'];
($_POST['edad'])? $edad=$_POST['edad']: $edad='NULL';
$name=reemplazarForm(quitarPuntos2($_POST['nombre']));
$pais=reemplazarForm(quitarPuntos2($_POST['pais']));
$sms='<div style="position:relative; margin:5px; left:3%; padding-top:50px;">';
$conUser=sqlQuery('SELECT * FROM usuarios WHERE usuario="'.$user.'" or email="'.$mail.'"');
if(sqlNumRow($conUser)!=0){
	$sms.='<span class="idenUserFail">el usuario ya existe.</span><br /><br />';
}
else{
	if(sqlQuery('INSERT INTO usuarios(usuario,pasword,email,edad,nombre,pais) VALUES ("'.$user.'","'.$pass.'","'.$mail.'",'.$edad.',"'.$name.'","'.$pais.'")')){
		$sms.='<span class="idenUserOk">registrado correctamente</span><br /><br />';
		$con=sqlFetch(sqlQuery('SELECT rangoUser,idenUser FROM usuarios WHERE usuario LIKE "'.$user.'" OR email LIKE "'.$mail.'"'));
		$sms.=login($time,$user,0,$con[0],NULL,$con[1])."<script>setTimeout(\"location.href='index.php'\",2000);</script>";
	}else{
		$sms.='<span class="idenUserFail">Error al registrar usuario</span><br /><br />';
	}
}
echo $sms.'</div>';
?>
