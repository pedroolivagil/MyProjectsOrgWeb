<?php
require_once('../config.php');
if (!Tools::isUserSession()) {
    header("Location: " . _ROOT_PATH_ . "login-error");
}
error_reporting(1);
Database::init_db();
Template::getHeader();
$breads = array(Translator::getTextStatic('PANEL_USER') => "");
Template::getBreadCrumbs($breads);
$user = User::findById(Tools::getCookie(SESSION_USUARIO_ID));
$totalProjects = $user->getAllProjects();
$pagina = $_REQUEST['pagina'];
?>
<!--// Content //-->
<div class="panel panel-primary panel-izquierda">
    <div class="panel-heading">
        <h4><?php echo Translator::getTextStatic('PANEL_USER_HEADER_CONTROL_PANEL'); ?></h4>
    </div>
    <div class="panel-body">
        <div class="container-avatar">
            <img src="<?php echo _IMAGE_PATH_ ?>avatar.jpg" class="thumbnail avatar center-block">
        </div>
        <div class="container-user-info">
            <ol class="list-group">
                <li class="list-group-item"><?php echo $user->getFullname(); ?></li>
                <li class="list-group-item"><?php echo $user->getCorreo(); ?></li>
            </ol>
            <div class="list-group">
                <a href="#" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_EDIT_PROFILE'); ?></a>
                <a href="#" class="list-group-item">
                    <?php echo Translator::getTextStatic('PANEL_USER_LABEL_PROYECTOS'); ?>
                    <span class="badge"><?php echo $user->countProjects(); ?></span>
                </a>
                <a href="#" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_NEW_PROJECT'); ?></a>
                <a href="#" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_FIND_PROJECT'); ?></a>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-derecha">
    <div class="panel-heading">
        <h4>
            <?php echo Translator::getTextStatic('PANEL_USER_HEADER_PROJECTS'); ?>
            <small class="color-white-50">(<?php echo $user->getCorreo(); ?>)</small>
        </h4>
    </div>
    <div class="panel-body">
        <?php if ($user->countProjects() > 0) { ?>
            <div class="row">
                <?php
                for ($x = 0; $x < LIMIT_RESULT_LIST; $x++) {
                    if ($x + (($pagina - 1) * LIMIT_RESULT_LIST) < $user->countProjects()) {
                        $project = $totalProjects[$x + (($pagina - 1) * LIMIT_RESULT_LIST)];
                        ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="<?php echo _IMAGE_PATH_ ?>avatar.jpg" alt="...">
                                <div class="caption">
                                    <h3><?php echo $project->getNombre(); ?></h3>
                                    <p>...</p>
                                    <p>
                                        <a href="#" class="btn btn-primary" role="button">Button</a>
                                        <a href="#" class="btn btn-default" role="button">Button</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>

            <!--// Paginador //-->
            <div class="text-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($x = 1; $x <= ceil($user->countProjects() / LIMIT_RESULT_LIST); $x++) { ?>
                            <li><a href="<?php echo _ROOT_PATH_; ?>user-panel/pag/<?php echo $x; ?>"><?php echo $x; ?></a></li>
    <?php } ?>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
<?php } ?>
    </div>
</div>
<?php
Template::getFooter();
Database::close_db();
