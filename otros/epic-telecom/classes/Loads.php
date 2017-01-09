<?php
$lang = ($_COOKIE['page_lang'])? $_COOKIE['page_lang'] : 'es';
require_once(_CLASS_PATH_.'Locale.php');
require_once(_CLASS_PATH_.'Tools.php');
Tools::init($lang);
require_once(_CLASS_PATH_.'Log.php');
require_once(_CLASS_PATH_.'Template.php');
require_once(_CLASS_PATH_.'Mail.php');
require_once(_CLASS_PATH_.'Client.php');
require_once(_CLASS_PATH_.'Category.php');
require_once(_CLASS_PATH_.'Service.php');
require_once(_CLASS_PATH_.'SubService.php');
require_once(_CLASS_PATH_.'Cart.php');
Tools::setNewCart();
?>