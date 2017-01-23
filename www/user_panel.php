<?php
require_once('../config.php');
if (!Tools::isUserSession()) {
    header("Location: " . _ROOT_PATH_ . "login-error");
}
Database::init_db();
Template::getHeader();
$breads = array(Translator::getTextStatic('PANEL_USER') => "");
Template::getBreadCrumbs($breads);
$user = User::findById(Tools::getCookie(SESSION_USUARIO_ID));
$totalProjects = $user->getAllActiveProjects();
$pagina = (!is_null($_REQUEST['pagina'])) ? $_REQUEST['pagina'] : 1;
$createpjt = ($_REQUEST['createpjt'] == TRUE) ? TRUE : FALSE;
?>
<!--// Content //-->
<?php include_once(_PHP_PATH_ . 'viewuser.php'); ?>

<?php
Template::getFooter();
Database::close_db();
