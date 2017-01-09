<?php
require_once('../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$category = 'centralitas virtuales';
$f_scripts = "<script>fillCaptionText(['".Tools::getLocale()->getString('INDEX_BREADCRUMP')."','".Tools::getLocale()->getString('PBX_BREADCRUMP')."']); changeCaptionImg('"._IMAGE_PATH_."caption/bg3.jpg'); actUserBar();</script>";

$sql = Tools::getDB()->query('SELECT * FROM rel_service_category WHERE id_cat = (SELECT id FROM category WHERE description LIKE "'.$category.'")');
$categoria = Tools::fillArray($sql);

/** generamos la consulta a todos los servicios de centralitas **/
$sql = Tools::getDB()->query('SELECT * FROM sub_service WHERE code_service LIKE "EXTENSION"');
$services = Tools::fillArray($sql);

/* generamos las tablas de preview, los 4($limit_preview) primeros productos */
$preview = Tools::separator();
$preview.= Template::getPreviewTable(array(
	'<big><big><strong>0€</strong></big></big><br />'.ucfirst(Tools::getLocale()->getString('startup')),
	'<big><big><strong>29,00€</strong></big></big><span class="min-60">/'.Tools::getLocale()->getString('unit_month').'<br />+ 3,00€ x '.Tools::getLocale()->getString('extension').'</span>'
	),
	'<a href="'._ROOT_PATH_.'add-to-cart/'.$categoria[0]['id_service'].'"><div class="glyphicon-pro cart-preview"></div></a>'
);

$preview.= Tools::separator();
$preview.= '<h5 class="text-center">'.Tools::getLocale()->getString('PBX_INFO').'</h5><br>';
foreach($services as $service){
	$preview.= Template::getPreviewTable(array(
		'<big>'.ucwords(Tools::getLocale()->getString('extension').' '.$service['attr1']).'</big>',
		'<big><big><strong>'.Tools::num_format($service['fee'],2).'€</strong></big></big><span class="min-60">/mes<br />'.ucfirst(Tools::getLocale()->getString('permanency')).': '.$service['permanency'].' '.Tools::getLocale()->getString('months')
	),'<a href="'._ROOT_PATH_.'add-sub-to-cart/'.$service['id'].'"><div class="glyphicon-pro cart-preview"></div></a>');
}

########## actualmente esta desabilitado el siguiente código hasta la creación de la plantilla
/* Generamos la tabla con todos los servicios de voz */
$sql = Tools::getDB()->query('SELECT * FROM rel_service_category WHERE id_cat = (SELECT id FROM category WHERE description LIKE "Líneas de voz")');
$services = Tools::fillArray($sql);

$content = Tools::separator();

$content.= '<p class="center">'.Tools::getLocale()->getString('MORE_TAX').'</p>';
$rows = '<tr>
			<th>'.Tools::getLocale()->getString('ldsip').'</th>
			<th>'.Tools::getLocale()->getString('startup').'</th>
			<th>'.Tools::getLocale()->getString('chanels').'<br />'.Tools::getLocale()->getString('simultaneous').'<br /><span class="min-60">'.Tools::getLocale()->getString('input').'/'.Tools::getLocale()->getString('output').'</span></th>
			<th>'.Tools::getLocale()->getString('mins').'<br />'.Tools::getLocale()->getString('includes').'<br /><span class="min-60">'.Tools::getLocale()->getString('landline').'/'.Tools::getLocale()->getString('smartphone').'</span></th>
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
			$subservices[0]['attr1'].'/'.$subservices[0]['attr2'],
			Tools::num_format($subservices[1]['attr2']).'/'.Tools::num_format($subservices[2]['attr2']),
			Tools::num_format($res['service_fee'],2).'€',
			'<a href="'._ROOT_PATH_.'add-to-cart/'.$res['id_service'].'"><span class="glyphicon-pro glyphicon-shopping-cart"></span></a>'
		),
		$row);
	}
	$x++;
}
$content.= Template::getSimpleTable($rows);		

// generamos la tabla de tarifas al minuto
$row = '<tr>
		<th>'.Tools::getLocale()->getString('callsto').'</th>
		<th>'.Tools::getLocale()->getString('price_min').'</th>
		<th>'.Tools::getLocale()->getString('establishment').'</th>
	</tr>
	<tr>
		<td>España fijos</td>
		<td>0.018€</td>
		<td>0.000€</td>
	</tr>
	<tr>
		<td>España móbiles</td>
		<td>0.080€</td>
		<td>0.000€</td>
	</tr>
	<tr>
		<td>España 901</td>
		<td>0.0718€</td>
		<td>0.0857€</td>
	</tr>
	<tr>
		<td>España 902</td>
		<td>0.1150€</td>
		<td>0.150€</td>
	</tr>
	<tr>
		<td>Internacionales</td>
		<td><small>desde </small>0.030€</td>
		<td>0.000€</td>
	</tr>';
$content.= Template::getSimpleTable($row, 'max-600');	
/*$row = '<tr>
		<th>'.Tools::getLocale()->getString('').'</th>
		<th>'.Tools::getLocale()->getString('').'</th>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>';
$content.= Template::getSimpleTable($row, 'max-600');*/

// Generamos la tabla de bonus de llamadas
$row = '<tr>
		<th>'.Tools::getLocale()->getString('bonus_to_phone').'</th>
		<th>'.Tools::getLocale()->getString('fee').' '.Tools::getLocale()->getString('mensual').'</th>
	</tr>';
$sql = Tools::getDB()->query('SELECT * FROM sub_service WHERE code_service LIKE "BMM"');
foreach(Tools::fillArray($sql) as $subserv){
	$row.='<tr>
		<td>'.Tools::num_format($subserv['attr2']).' '.Tools::getLocale()->getString('mins').((!Tools::isEmpty($subserv['attr3']))? ' '.Tools::getLocale()->getString('to').' '.$subserv['attr3'].' '.Tools::getLocale()->getString('nums') : '').'</td>
		<td>'.Tools::num_format($subserv['fee'],2).'€</td>
	</tr>';
}
$content.= Template::getSimpleTable($row, 'max-400');
$content = Tools::separator();

$tpl = new Template($f_scripts);
$tpl->setContentPage('tpl.php',array(
	'[TITLE]' => Tools::getLocale()->getString('PBX_TITLE'),
	'[SUBTITLE]' => Tools::getLocale()->getString('PBX_SUBTITLE'),
	'[PREVIEW]' => $preview,
	'[CONTENT]' => $content,
	'[FOOTER]' => Tools::getLocale()->getString('PBX_FOOTER')
	)
);

print Tools::htmlEntityDecode($tpl->getHeader());
print Tools::htmlEntityDecode($tpl->getContentPage());
print Tools::htmlEntityDecode($tpl->getFooter());
Tools::closeDB();
?>