<?php

require_once('../config.php');

//header('Content-type: application/json');
header('Content-type: text/plain');
echo strlen(23);
$relacion = array(
    COL_ID_PROYECTO => '$id_proyecto',
    COL_ID_USUARIO => '$id_client'
);
var_dump($relacion);
$claves = array_keys($relacion);
$values = array_values($relacion);
implode(",", $claves) . " - ";
implode(",", $values);

echo "\n\n" . Tools::encrypt("1234");
echo "\n\n" . Tools::encrypt(1234);
echo "\n\n";
$proyecto = json_decode('{"id_proyecto":"8ad8d5fe4bc94544ac3d","nombre":"proyecto","description":"saregndxsfrggnserdgffnsdrfgnrdfgtnsg","flag_activo":true,"flag_finish":true,"directorio_root":"dd548de3748845f9a621c680ffeb5c19","home_image":"home.jpg","project_images":[{"id_imagen":"5c0731bd38874caa8f92","url":"body3ab7a422-928e-48bc-9dff-7d941e90e013.jpg","width":640,"height":480,"descripcion":"xfhgmchgfmcgfhm"},{"id_imagen":"2ecf9be262314312959b","url":"home5d23fbb2-4eb4-4650-8751-3c0c6a2b7d83.jpg","width":640,"height":480,"descripcion":"xfhmfdhgmxfgh"},{"id_imagen":"4703359055f34845b3dc","url":"body54ea4a95-a888-469f-9be1-12da45d88bab.jpg","width":640,"height":480,"descripcion":"degtmnxfhgmgfh"}],"project_targets":[{"id_tarjeta":"81fd149ad9b4404694cf","label":"rgndxfgnxfgnxfdg","valor":"nxfdgnfxdgnfdrgn"},{"id_tarjeta":"d41c0f15927b4d29a2bc","label":"gnxdfgnxdfgnfrxdg","valor":"nxfdgnxfdgnxdfgn"},{"id_tarjeta":"44d5d9e7778c4088b79a","label":"fgnxdfgnxdfgnxfdgn","valor":"fdgndfxgnxdfgnfgn"},{"id_tarjeta":"f9d8d602201a4d1fba56","label":"fghmghmghmg","valor":"hmghmghmghg"},{"id_tarjeta":"781af02edbce4182acbe","label":"g chmcghmcghm","valor":"cghmgmcfghmcgh,ghj,hgj"}]}', true);
//var_dump($proyecto);
//var_dump($proyecto['project_targets'][0]['label']);
/* array_push($relacion, 1);
  $arr = array("COL_ID_TARJETA" => "rwegaerfgbedrfg");
  array_merge($relacion, $arr);
  var_dump($relacion); */
Database::init_db();
$err = 0;
$user = 'olivadevelop@gmail.com';
$pass = '1234';
$params = array(
    COL_ID_USUARIO => Tools::encrypt($user)
);
$usuario = Database::preparedQuery(UsuarioFindById, $params);
var_dump($usuario);
$pwd = Tools::encrypt($pass);
if ($usuario != NULL) {
    $user_pass = $usuario[0]['user_pass'];
    if ($pwd != $user_pass) {
        $err++;
    }
} else {
    $err++;
}
if ($err == 0) {
    $time = ($auto) ? EXPIRE * 15 * 12 : EXPIRE; // 1 año o 2 días
    Tools::setCookie(SESSION_USUARIO_ID, $usuario[0][COL_ID_USUARIO], $time);
    Tools::setCookie(SESSION_USUARIO_NAME, $usuario[0]['fullname'], $time);
    return TRUE;
} else {
    return FALSE;
}
Database::close_db();
?>