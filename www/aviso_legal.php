<?php
require_once('../config.php');
Database::init_db();
Template::getHeader();
$breads = array(Translator::getTextStatic('LEGAL_PAGE') => "");
Template::getBreadCrumbs($breads);
Template::getLegalFile();
Template::getFooter();
Database::close_db();
?>
