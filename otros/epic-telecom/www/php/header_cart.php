<?php
$serv = new Service($cart->getService());
$cat = new Category($serv->getCategory());
$cart->setTotal($serv->getFee());
$cart->setTotalEntry($serv->getFeeHigh());
$sub = new SubService();
$subs = $cart->getSubServices();
$servicios = array();
if(!Tools::isEmpty($subs)){
	foreach($subs as $subservice){
		$sub->select($subservice);
		$sub2 = new SubService();
		if($cat->getID() == 2){
			$sub2->selectByCodeService('INST_EXTENSION');
		}
		if(in_array($cat->getID(), $sub->getAvailable())){
			$cart->addTotal($sub->getFee() + $sub2->getFee());
			$cart->addTotalEntry($sub->getEntryFee() + $sub2->getEntryFee());
			array_push($servicios, $sub->getID());
		}
	}
	$servicios = array_count_values($servicios);
}else{
	$cart->del_allsubservices();
}
?>