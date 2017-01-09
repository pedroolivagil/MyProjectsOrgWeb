<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$cart = Tools::getCart();
$cart->unset_cart();

header('Location: '.$_SERVER['HTTP_REFERER']);
?>