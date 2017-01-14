<?php
require_once('../config.php');
if (!Tools::isUserSession()) {
    header("Location: " . _ROOT_PATH_ . "login-error");
}
Database::init_db();
Template::getHeader();
$id = (!is_null($_REQUEST['id'])) ? $_REQUEST['id'] : 0;
$user = User::findById(Tools::getCookie(SESSION_USUARIO_ID));
$project = $user->getProjectById($id);
$breads = array(
    Translator::getTextStatic('PANEL_USER') => "user-panel",
    //Translator::getTextStatic('GENERIC_VIEW_PROJECT') => ""
    ucfirst($project->getNombre()) => ""
);
Template::getBreadCrumbs($breads);
$totalProjects = $user->getAllProjects();
?>
<!--// Content //-->
<?php include_once(_PHP_PATH_ . 'viewuser.php'); ?>
<div class="panel panel-primary panel-derecha">
    <div class="panel-heading">
        <h4>
            <?php echo ucfirst($project->getNombre()); ?>
            <small class="color-white-50">(<?php echo $user->getCorreo(); ?>)</small>
        </h4>
    </div>
    <div class="panel-body">
        
    </div>
    <div class="panel-footer">
        <div class="text-right">
            <div class="btn-group" role="group">
                <a href="<?php echo _ROOT_PATH_.'user-panel' ?>" class="btn btn-default"><?php echo Translator::getTextStatic('GENERIC_BACK'); ?></a>
                <button type="button" class="btn btn-primary"><?php echo Translator::getTextStatic('GENERIC_EDIT'); ?></button>
                <button type="button" class="btn btn-danger"><?php echo Translator::getTextStatic('GENERIC_DELETE'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php
Template::getFooter();
Database::close_db();
