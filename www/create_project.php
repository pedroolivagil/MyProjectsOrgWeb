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
$newID = Tools::generateUUID(20);
Template::getBreadCrumbs($breads);
$createpjt = ($_REQUEST['error'] == TRUE) ? TRUE : FALSE;
?>
<!--// Content //-->
<form method="post" name="formulario" enctype="multipart/form-data" action="<?php echo _ROOT_PATH_ . 'user-project/new-project'; ?>">
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
    <?php if ($createpjt) { ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p><?php echo Translator::getTextStatic('GENERIC_ERROR_SAVE'); ?></p>
        </div>
    <?php } ?>
    <div class="form-group width100">
        <label class="sr-only" for="newproject_name"><?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_NAME'); ?></label>
        <input type="text" maxlength="128" class="form-control width100" name="newproject_name" id="newproject_name" placeholder="<?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_NAME'); ?>">
    </div>
    <div class="row max-height-config-pjt well well-sm no-corners" id="config_project">
        <div class="form-group col-md-6 pad5-lr">
            <label class="sr-only" for="newproject_description"><?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_DESCRIPTION'); ?></label>
            <textarea maxlength="2500" class="form-control height-new-description" name="newproject_description" id="newproject_description" placeholder="<?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_DESCRIPTION'); ?>"></textarea>
        </div>
        <div class="form-group col-md-6 pad5-lr">
            <label class="sr-only" for="newproject_id"><?php echo Translator::getTextStatic('PANEL_LABEL_LABEL_NEW_PROJECT_ID'); ?></label>
            <input type="text" class="form-control disabled" disabled name="newproject_id" id="newproject_id" value="<?php echo $newID; ?>" placeholder="<?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_'); ?>" readonly>
            <?php //usamos este -> ?><input type="hidden" name="newproject_id_project" id="newproject_id_project" value="<?php echo $newID; ?>">
        </div>
    </div>

    <div class="row">
        <div id="header_img_preview" class="col-md-3">
            <h5><?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_HEADER_IMG'); ?></h5>
            <h6><?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_HEADER_IMG_EMPTY'); ?></h6>
        </div>
        <div id="image-holder" class="col-md-9">
            <h5><?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_PROJECT_IMG'); ?></h5>
            <h6><?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_PROJECT_IMG_EMPTY'); ?></h6>
        </div>
    </div>

    <!--// Imagen de cabecera //-->
    <label class="hidden">
        <!--<input type="file" id="header_img" name="header_img" onchange="readURL(this, 'header_img_preview')">-->
        <input type="file" id="header_img" name="header_img" onchange="readImg(this, 'header_img_preview', '<?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_HEADER_IMG'); ?>')">
        <span class="custom-file-control"></span>
    </label>
    <!--// Imágenes de proyecto //-->
    <label class="hidden">
        <input type="file" id="projectImg" name="projectImg[]" multiple onchange="readImg(this, 'image-holder', '<?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_PROJECT_IMG'); ?>')">
        <span class="custom-file-control"></span>
    </label>
    <?php
    Template::closePanelBody();
    Template::openPanelFooter();
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group dropup" role="group">
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                    <?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_BTN_ADD_MORE'); ?>&nbsp;&nbsp;
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="javascript:addField();"><?php echo Translator::getTextStatic('GENERIC_ADD_FIELD'); ?></a></li>
                    <li><a href="javascript:clickElement('header_img');"><?php echo Translator::getTextStatic('PANEL_NEW_PROJECT_HEADER_SELECT_FILE'); ?></a></li>
                    <li><a href="javascript:clickElement('projectImg');"><?php echo Translator::getTextStatic('GENERIC_SELECT_FILE_MULTIPLE'); ?></a></li>
                </ul>
            </div>
        </div>
        <div class="text-right col-md-6">
            <div class="btn-group" role="group">
                <a href="<?php echo _ROOT_PATH_ . 'user-project' ?>" class="btn btn-default"><?php echo Translator::getTextStatic('GENERIC_BACK'); ?></a>
                <button type="submit" onclick="return validateInputFiles('projectImg',<?php echo MAX_IMAGES_PROJECT; ?>, '<?php echo Translator::getTextStatic('GENERIC_ERROR_VALIDATION'); ?>', '<?php echo Translator::getTextStatic('GENERIC_LABEL_MAX_FILES'); ?>');" class="btn btn-success"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_NEW_PROJECT'); ?></button>
            </div>
        </div>
    </div>
    <?php
    Template::closePanelFooter();
    Template::closePanel();
    ?>
</form>
<script type="text/javascript">
    contadorFields = 0;
    contadorImages = 0;
    maxfileds = <?php echo MAX_FIELDS_PROJECT; ?>;
    maximages = <?php echo MAX_IMAGES_PROJECT; ?>;
    function addField() {
        var phdr1 = '<?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_TARGET_LABEL'); ?>';
        var phdr2 = '<?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_TARGET_VALUE'); ?>';
        var div = '<div class="col-md-6 pad5-lr">';
        div += '     <div class="list-group width100">';
        div += '        <input maxlength="255" type="text" class="list-group-item width100 btn-primary-important" name="newproject_target_label[]" id="newproject_target_label[]" placeholder="' + phdr1 + '">';
        div += '        <textarea maxlength="1000" class="list-group-item width100 panel-primary" name="newproject_target_value[]" id="newproject_target_value[]" placeholder="' + phdr2 + '"></textarea>';
        div += '    </div>';
        div += '</div>';
        if (contadorFields < maxfileds) {
            $('div#config_project').append(div);
            scrollBottom('config_project');
            scrollBottom();
            contadorFields++;
        } else {
            showAlert('<?php echo Translator::getTextStatic('GENERIC_ERROR_VALIDATION'); ?>', '<?php echo Translator::getTextStatic('PANEL_LABEL_NEW_PROJECT_ERROR_MAX_FIELDS'); ?>');
        }
    }
    function readImg(input, divID, title) {
        //Get count of selected file
        if (contadorImages <= maximages) {
            printPreviewImage('<?php echo Translator::getTextStatic('GENERIC_ERROR_VALIDATION'); ?>', '<?php echo Translator::getTextStatic('GENERIC_ONLY_IMAGES'); ?>', input, divID, title);
            scrollBottom();
        } else {
            showAlert('<?php echo Translator::getTextStatic('GENERIC_ERROR_VALIDATION'); ?>', '<?php echo Translator::getTextStatic('GENERIC_LABEL_MAX_FILES'); ?>');
        }
    }
</script>
<?php
Template::getFooter();
Database::close_db();
