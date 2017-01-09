<?php
require_once('../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$category = 'internet aire';
$f_scripts = "<script>fillCaptionText(['".Tools::getLocale()->getString('INDEX_BREADCRUMP')."','".Tools::getLocale()->getString('AIRE_BREADCRUMP')."']); changeCaptionImg('"._IMAGE_PATH_."caption/bg5.jpg'); actUserBar();</script>";

/** generamos la consulta a todos los servicios de voz **/
$sql = Tools::getDB()->query('SELECT * FROM rel_service_category WHERE id_cat = (SELECT id FROM category WHERE description LIKE "'.$category.'")');
$services = Tools::fillArray($sql);

/* generamos las tablas de preview, los 4($limit_preview) primeros productos */
$preview = Tools::separator();
$x = 0;
$limit_preview = 4;
foreach($services as $service){
	$sql = Tools::getDB()->query('SELECT * FROM service  WHERE id_service = '.$service['id_service']);
	if($res = $sql->fetch_array() and $x < $limit_preview){
		$sql = Tools::getDB()->query('SELECT * FROM rel_service_subservice WHERE id_service = '.$service['id_service']);
		$idsserv = Tools::fillArray($sql);
		$subservices = array();
		foreach($idsserv as $id){
			$sql = Tools::getDB()->query('SELECT * FROM sub_service WHERE id = '.$id['id_subservice']);
			if($res2 = $sql->fetch_array()){
				array_push($subservices, $res2);
			}
		}
		$preview.= Template::getPreviewTable(array(
			ucwords($res['description']).'',
			'<big><big><strong>'.Tools::num_format($res['service_fee'],2).'€</strong></big></big>'),
			'<a href="'._ROOT_PATH_.'add-to-cart/'.$res['id_service'].'"><div class="glyphicon-pro cart-preview"></div></a>'
		);
	}
	$x++;
}
/* Generamos la tabla con todos los servicios de internet aire */
$content = Tools::separator();
$content.= '<p class="center">'.Tools::getLocale()->getString('MORE_TAX').'</p>';
$rows = '<tr>
			<th>'.Tools::getLocale()->getString('ldsip').'</th>
			<th>'.Tools::getLocale()->getString('startup').'</th>
			<th>'.Tools::getLocale()->getString('speed').'<br />'.Tools::getLocale()->getString('download').'</span></th>
			<th>'.Tools::getLocale()->getString('speed').'<br />'.Tools::getLocale()->getString('upload').'</span></th>
			<th>'.Tools::getLocale()->getString('fee').'<br />'.Tools::getLocale()->getString('mensual').'</th>
			<th>'.Tools::getLocale()->getString('contract').'</th>
		</tr>';

reset($services);
foreach($services as $service){
	$sql = Tools::getDB()->query('SELECT * FROM service  WHERE id_service = '.$service['id_service']);
	if($res = $sql->fetch_array()){
		$sql = Tools::getDB()->query('SELECT * FROM rel_service_subservice WHERE id_service = '.$service['id_service']);
		$idsserv = Tools::fillArray($sql);
		$subservices = array();
		foreach($idsserv as $id){
			$sql = Tools::getDB()->query('SELECT * FROM sub_service WHERE id = '.$id['id_subservice']);
			if($res2 = $sql->fetch_array()){
				array_push($subservices, $res2);
			}
		}
		$row = '<tr>
					<td>[STR1]</td>
					<td>[STR2]</td>
					<td>[STR3]</td>
					<td>[STR4]</td>
					<td>[STR5]</td>
					<td>[BTNS]</td>
				</tr>';
		$rows.= str_replace(
		array(
			'[STR1]','[STR2]','[STR3]','[STR4]','[STR5]','[BTNS]'
		),
		array(
			ucwords($res['description']),
			Tools::num_format($res['entry_fee'],2).'€',
			$subservices[0]['attr1'].' Mbps',
			$subservices[0]['attr2'].' Mbps',
			Tools::num_format($res['service_fee'],2).'€',
			'<a href="'._ROOT_PATH_.'add-to-cart/'.$res['id_service'].'"><span class="glyphicon-pro glyphicon-shopping-cart"></span></a>'
			),
		$row
		);
	}
	$x++;
}
$content.= Template::getSimpleTable($rows);
$sql = Tools::getDB()->query('SELECT * FROM sub_service WHERE code_service LIKE "T_PLANA"');
$tplana = $sql->fetch_array();
$content.= Template::getPreviewTable(array(
	'<big>'.ucwords(Tools::getLocale()->getString('calls_flat_rate')).'</big>',
	'<big><big><strong>'.Tools::num_format($tplana['fee'],2).'€</strong></big></big><span class="min-60">/'.Tools::getLocale()->getString('unit_month').'</span><br /><span class="min-60">'.Tools::num_format($tplana['attr1']).' '.Tools::getLocale()->getString('min').' '.Tools::getLocale()->getString('to').' '.Tools::getLocale()->getString('landline').' '.Tools::getLocale()->getString('nationals').'<br />'.Tools::num_format($tplana['attr2']).' '.Tools::getLocale()->getString('min').' '.Tools::getLocale()->getString('to').' '.Tools::getLocale()->getString('smartphone').' '.Tools::getLocale()->getString('nationals').'</span>'),'<a href="'._ROOT_PATH_.'add-sub-to-cart/'.$tplana['id'].'"><div class="glyphicon-pro cart-preview"></div></a>');

$tpl = new Template($f_scripts);
$tpl->setContentPage('tpl.php',array(
	'[TITLE]' => Tools::getLocale()->getString('AIRE_TITLE'),
	'[SUBTITLE]' => Tools::getLocale()->getString('AIRE_SUBTITLE'),
	'[PREVIEW]' => $preview,
	'[CONTENT]' => $content,
	'[FOOTER]' => Tools::getLocale()->getString('AIRE_FOOTER')
	)
);

print Tools::htmlEntityDecode($tpl->getHeader());
print Tools::htmlEntityDecode($tpl->getContentPage());
print Tools::htmlEntityDecode($tpl->getFooter());
Tools::closeDB();
?>