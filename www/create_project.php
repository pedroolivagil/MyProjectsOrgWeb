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
$sizeTable = 0;
foreach ($project->getImagenes() as $img) {
    $image = ImageProject::getNewImage($img);
    $url = $project->getUrlImg($user->getId_usuario()) . $image->getUrl();
    $size = getimagesize($url);
    $sizeTable += Tools::resizeImgHW($size[1], $size[0], HEIGHT_THUMB_VIEW_PJT) + 4;
}
$breads = array(
    Translator::getTextStatic('PANEL_USER') => "user-panel",
    Translator::getTextStatic('PANEL_USER_LABEL_NEW_PROJECT') => ""
);
Template::getBreadCrumbs($breads);
?>
<!--// Content //-->
<form>
    <?php
    include_once(_PHP_PATH_ . 'viewuser.php');
    Template::openPanel();
    Template::openPanelHeader();
    ?>
    <h4>
        <?php echo Translator::getTextStatic('PANEL_USER_LABEL_NEW_PROJECT'); ?>
        <small class="color-white-50">(<?php echo $user->getCorreo(); ?>)</small>
    </h4>
    <?php
    Template::closePanelHeader();
    Template::openPanelBody();
    ?>
    <div class="form-group width100">
        <label class="sr-only" for="newproject_"><?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_NAME'); ?></label>
        <input type="text" class="form-control width100" name="newproject_" id="newproject_" placeholder="<?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_NAME'); ?>">
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="sr-only" for="newproject_"><?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_'); ?></label>
            <textarea class="form-control" name="newproject_" id="newproject_" placeholder="<?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_'); ?>"></textarea>
        </div>
        <div class="form-group col-md-6">
            <label class="sr-only" for="newproject_id_project"><?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_'); ?></label>
            <input type="text" class="form-control disabled" name="newproject_id_project" id="newproject_id_project" value="<?php echo Tools::generateUUID(20); ?>" placeholder="<?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_'); ?>" readonly>
        </div>
        <div class="form-group col-md-6">
            <label class="sr-only" for="newproject_"><?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_'); ?></label>
            <input type="text" class="form-control" name="newproject_" id="newproject_" placeholder="<?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_'); ?>">
        </div>
        <div class="form-group col-md-6">
            <label class="sr-only" for="newproject_"><?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_'); ?></label>
            <input type="text" class="form-control" name="newproject_" id="newproject_" placeholder="<?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_'); ?>">
        </div>
    </div>
    <div>
        <button type="button" onclick="clickElement('header_img')" class="btn btn-primary"><?php echo Translator::getTextStatic('GENERIC_SELECT_FILE'); ?></button>
        <label class="col-md-6 hidden">
            <input type="file" id="header_img" name="header_img">
            <span class="custom-file-control"></span>
        </label>
    </div>
    <?php
    Template::closePanelBody();
    Template::openPanelFooter();
    ?>
    <div class="text-right">
        <div class="btn-group" role="group">
            <a href="<?php echo _ROOT_PATH_ . 'user-panel' ?>" class="btn btn-default"><?php echo Translator::getTextStatic('GENERIC_BACK'); ?></a>
            <button type="submit" class="btn btn-success"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_NEW_PROJECT'); ?></button>
        </div>
    </div>
    <?php
    Template::closePanelFooter();
    Template::closePanel();
    ?>
</form>
<?php
Template::getFooter();
Database::close_db();
