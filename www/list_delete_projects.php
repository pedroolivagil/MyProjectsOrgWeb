<?php
require_once('../config.php');
if (!Tools::isUserSession()) {
    header("Location: " . _ROOT_PATH_ . "login-error");
}
Database::init_db();
Template::getHeader();
$user = User::findById(Tools::getCookie(SESSION_USUARIO_ID));
$projects = $user->getAllActiveProjects();
$breads = array(
    Translator::getTextStatic('PANEL_USER') => "user-panel",
    Translator::getTextStatic('PANEL_TITLE_LIST_TABLE') => ""
);
Template::getBreadCrumbs($breads);
?>
<!--// Content //-->
<?php
include_once(_PHP_PATH_ . 'viewuser.php');
Template::openPanel();
Template::openPanelHeader();
?>
<h4>
    <?php echo Translator::getTextStatic('PANEL_TITLE_LIST_TABLE'); ?>
    <small class="color-white-50">(<?php echo $user->getCorreo(); ?>)</small>
</h4>
<?php
Template::closePanelHeader();
Template::openPanelBody();
?>
<table class="table table-bordered table-striped table-hover table-responsive">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>F. Creación</th>
        <th>Opciones</th>
    </tr>
    <?php foreach ($projects as $pjt) { ?>
        <tr>
            <td><?php echo $pjt->getId_proyecto(); ?></td>
            <td><?php echo $pjt->getNombre(); ?></td>
            <td><?php echo $pjt->getFecha_creacion(); ?></td>
            <td>ver/editar/borrar</td>
        </tr>
    <?php } ?>

</table>
<?php
Template::closePanelBody();
Template::closePanel();

Template::getFooter();
Database::close_db();
