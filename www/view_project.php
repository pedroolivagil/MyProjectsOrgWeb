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
<?php
include_once(_PHP_PATH_ . 'viewuser.php');
Template::openPanel();
Template::openPanelHeader();
?>
<h4>
    <?php echo ucfirst($project->getNombre()); ?>
    <small class="color-white-50">(<?php echo $user->getCorreo(); ?>)</small>
</h4>
<?php
Template::closePanelHeader();
Template::openPanelBody();
?>
<div class="row mar1-l">
    <div class="float-container-left"> <!-- container Img/s -->
        <!-- Container img -->
        <div class="container-img-principal overflow-hidden">
            <a class="preview" href="#" data-image-id="<?php echo $user->getId_usuario(); ?>" data-toggle="modal" data-title="<?php echo $project->getNombre(); ?>" data-caption="" data-image="<?php echo $project->getHomeImg($user->getId_usuario()); ?>" data-target="#image-gallery">
                <img src="<?php echo $project->getHomeImg($user->getId_usuario()); ?>" />
            </a>
        </div>
        <!-- Container imgs -->
        <div class="container-img-project well well-sm mar10-tb overflow-x max-height-350">
            <?php
            if (count($project->getImagenes()) > 0) {
                foreach ($project->getImagenes() as $img) {
                    $image = ImageProject::getNewImage($img);
                    $url = $project->getUrlImg($user->getId_usuario()) . $image->getUrl();
                    ?>
                    <a class="preview" href="#" data-image-id="<?php echo $image->getId_imagen(); ?>" data-toggle="modal" data-title="<?php echo $project->getNombre(); ?>" data-caption="<?php echo Tools::formatOutput($image->getDescripcion()); ?>" data-image="<?php echo $url; ?>" data-target="#image-gallery">
                        <img src="<?php echo $url; ?>" class="img-thumbnail height-57" />
                    </a>
                    <?php
                }
            } else {
                echo Translator::getTextStatic('PROJECT_NOT_HAVE_IMAGES');
            }
            ?>
        </div>
        <div class="well well-sm"> <!-- container description -->
            <h4 class="h4"><span><?php echo Translator::getTextStatic('GENERIC_DESCRIPTION') ?></span></h4>
            <p class="text-justify"><?php echo Tools::formatOutput($project->getDescription()); ?></p>
        </div>
    </div>
    <div class="float-container-left-15"> <!-- container targets -->
        <?php
        if (count($project->getTarjetas()) > 0) {
            foreach ($project->getTarjetas() as $tjs) {
                $target = TargetProject::getNewTarget($tjs);
                ?>
                <div class="well well-sm mar10-b">
                    <h4 class="h4"><span><?php echo Tools::formatOutput($target->getLabel(), 40); ?></span></h4>
                    <p class="text-justify"><?php echo Tools::formatOutput($target->getValor()); ?></p>
                </div>
                <?php
            }
        } else {
            echo Translator::getTextStatic('PROJECT_NOT_HAVE_TARGETS');
        }
        ?>
    </div>
</div>
<div class="row mar1-l">
    <div class=""> <!-- container description -->

    </div>
</div>
<?php
Template::closePanelBody();
Template::openPanelFooter();
?>
<div class="text-right">
    <div class="btn-group" role="group">
        <a href="<?php echo _ROOT_PATH_ . 'user-panel' ?>" class="btn btn-default"><?php echo Translator::getTextStatic('GENERIC_BACK'); ?></a>
        <button type="button" class="btn btn-primary"><?php echo Translator::getTextStatic('GENERIC_EDIT'); ?></button>
        <button type="button" class="btn btn-danger"><?php echo Translator::getTextStatic('GENERIC_DELETE'); ?></button>
    </div>
</div>
<?php
Template::closePanelFooter();
Template::closePanel();

Template::getFooter();
Database::close_db();
