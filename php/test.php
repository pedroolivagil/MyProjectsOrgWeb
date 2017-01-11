<?php

require_once('../config.php');

//header('Content-type: application/json');
header('Content-type: text/plain');


echo "\n" . Tools::encrypt("1234");
echo "\n" . Tools::encrypt(1234);
echo "\n\n" . Tools::cryptpass("1234") . ' (' . strlen(Tools::cryptpass("1234")).')';
echo "\n" . Tools::cryptpass(1234) . ' (' . strlen(Tools::cryptpass(1234)).')';
echo "\n\n";
$proyecto = json_decode('{"id_proyecto":"8ad8d5fe4bc94544ac3d","nombre":"proyecto","description":"saregndxsfrggnserdgffnsdrfgnrdfgtnsg","flag_activo":true,"flag_finish":true,"directorio_root":"dd548de3748845f9a621c680ffeb5c19","home_image":"home.jpg","project_images":[{"id_imagen":"5c0731bd38874caa8f92","url":"body3ab7a422-928e-48bc-9dff-7d941e90e013.jpg","width":640,"height":480,"descripcion":"xfhgmchgfmcgfhm"},{"id_imagen":"2ecf9be262314312959b","url":"home5d23fbb2-4eb4-4650-8751-3c0c6a2b7d83.jpg","width":640,"height":480,"descripcion":"xfhmfdhgmxfgh"},{"id_imagen":"4703359055f34845b3dc","url":"body54ea4a95-a888-469f-9be1-12da45d88bab.jpg","width":640,"height":480,"descripcion":"degtmnxfhgmgfh"}],"project_targets":[{"id_tarjeta":"81fd149ad9b4404694cf","label":"rgndxfgnxfgnxfdg","valor":"nxfdgnfxdgnfdrgn"},{"id_tarjeta":"d41c0f15927b4d29a2bc","label":"gnxdfgnxdfgnfrxdg","valor":"nxfdgnxfdgnxdfgn"},{"id_tarjeta":"44d5d9e7778c4088b79a","label":"fgnxdfgnxdfgnxfdgn","valor":"fdgndfxgnxdfgnfgn"},{"id_tarjeta":"f9d8d602201a4d1fba56","label":"fghmghmghmg","valor":"hmghmghmghg"},{"id_tarjeta":"781af02edbce4182acbe","label":"g chmcghmcghm","valor":"cghmgmcfghmcgh,ghj,hgj"}]}', true);

?>