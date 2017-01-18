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
<table class="table table-bordered table-hover table-responsive">
    <tr class="bg-gray-10">
        <th><span data-toggle="tooltip" title="Seleccionados">Sel.</span></th>
        <th><span data-toggle="tooltip" title="Nombre">Nombre</span></th>
        <th><span data-toggle="tooltip" title="Terminado">Term.</span></th>
        <th><span data-toggle="tooltip" title="Descripción">Descrip.</span></th>
        <th><span data-toggle="tooltip" title="Fecha de creación">F. Creación</span></th>
        <th><span data-toggle="tooltip" title="Última actualización">Últ. act.</span></th>
    </tr>
    <?php
    $x = 0;
    foreach ($projects as $pjt) {
        ?>
        <tr>
            <td class="text-center">
                <input type="checkbox" id="row_table<?php echo $x; ?>" name="row_table" value="<?php echo $pjt->getId_proyecto(); ?>" />
            </td>
            <td onclick="clickElement('row_table<?php echo $x; ?>')"><?php echo $pjt->getNombre(); ?></td>
            <td onclick="clickElement('row_table<?php echo $x; ?>')" class="text-center"><?php echo Tools::printLiteralBool($pjt->getFlag_finish()); ?></td>
            <td onclick="clickElement('row_table<?php echo $x; ?>')"><?php echo Tools::formatOutput($pjt->getDescription(), 20); ?></td>
            <td onclick="clickElement('row_table<?php echo $x; ?>')"><?php echo Tools::formatDate($pjt->getFecha_creacion()); ?></td>
            <td onclick="clickElement('row_table<?php echo $x; ?>')"><?php
                if ($pjt->getFecha_creacion() != $pjt->getFecha_actualizacion()) {
                    echo Tools::formatDate($pjt->getFecha_actualizacion());
                } else {
                    echo '- - -';
                }
                ?>
            </td>
        </tr>
        <?php
        $x++;
    }
    ?>
</table>
<?php
Template::closePanelBody();
Template::openPanelFooter();
?>
<div class="text-right">
    <div class="btn-group" role="group">
        <a href="<?php echo _ROOT_PATH_ . 'user-panel' ?>" class="btn btn-default"><?php echo Translator::getTextStatic('GENERIC_BACK'); ?></a>
        <a class="btn btn-danger" onclick="showAlertDelete('<?php echo 'Eliminar'; ?>', 'row_table', '<?php echo _ROOT_PATH_ . 'user-panel/delete-project' ?>')"><?php echo Translator::getTextStatic('GENERIC_DELETE'); ?></a>
    </div>
</div>
<?php
Template::closePanelFooter();
Template::closePanel();

Template::getFooter();
Database::close_db();
