<?php
require_once('../config.php');
if (!Tools::isUserSession()) {
    header("Location: " . _ROOT_PATH_ . "login-error");
}
Database::init_db();
Template::getHeader();
$breads = array(Translator::getTextStatic('PANEL_USER') => "");
Template::getBreadCrumbs($breads);
?>

<!--// Content //-->

<?php
Template::getFooter();
Database::close_db();
?>