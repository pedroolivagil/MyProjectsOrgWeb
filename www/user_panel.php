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

<div class="panel panel-primary panel-derecha">
    <div class="panel-heading">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h4>
                        <?php echo Translator::getTextStatic('PANEL_USER_HEADER_PROJECTS'); ?>
                        <small class="color-white-50">(<?php echo $user->getCorreo(); ?>)</small>
                    </h4>
                </div>
                <div class="col-md-4">
                    <form class="form-search" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?php if ($createpjt) { ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p><?php echo Translator::getTextStatic('GENERIC_SUCCESS_SAVE'); ?></p>
            </div>
            <?php
        }
        if ($user->countActiveProjects() > 0) {
            ?>
            <div class="row">
                <?php
                for ($x = 0; $x < LIMIT_RESULT_LIST; $x++) {
                    if ($x + (($pagina - 1) * LIMIT_RESULT_LIST) < $user->countActiveProjects()) {
                        $project = $totalProjects[$x + (($pagina - 1) * LIMIT_RESULT_LIST)];
                        ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="<?php echo _IMAGE_PATH_ ?>avatar.jpg" alt="...">
                                <div class="caption">
                                    <div data-toggle="tooltip" title="<?php echo $project->getNombre(); ?>">
                                        <h3><?php echo Tools::cutOutput($project->getNombre(), 15); ?></h3>
                                    </div>
                                    <p class="text-justify">
                                        <?php echo Tools::cutOutput($project->getDescription(), 50); ?>
                                    </p>
                                    <p><a href="<?php echo _ROOT_PATH_ . 'user-panel/view-project/' . $project->getId_proyecto(); ?>" class="btn btn-primary" role="button"><?php echo Translator::getTextStatic('GENERIC_VIEW_PROJECT'); ?></a></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_NO_HAVE_PROJECTS'); ?></div>
        <?php } ?>
    </div>
    <div class="panel-footer">
        <?php if ($user->countActiveProjects() > 0) { ?>
            <!--// Paginador //-->
            <div class="text-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li <?php echo ($pagina <= 1) ? 'class="disabled"' : '' ?>>
                            <a href="<?php echo _ROOT_PATH_; ?>user-panel/pag/<?php echo ($pagina - 1 < 1) ? 1 : $pagina - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($x = 1; $x <= ceil($user->countActiveProjects() / LIMIT_RESULT_LIST); $x++) { ?>
                            <li <?php echo ($pagina == $x) ? 'class="active"' : '' ?>><a href="<?php echo _ROOT_PATH_; ?>user-panel/pag/<?php echo $x; ?>"><?php echo $x; ?></a></li>
                        <?php } ?>
                        <li <?php echo ($pagina >= ceil($user->countActiveProjects() / LIMIT_RESULT_LIST)) ? 'class="disabled"' : '' ?>>
                            <a href="<?php echo _ROOT_PATH_; ?>user-panel/pag/<?php echo ($pagina + 1 > ceil($user->countActiveProjects() / LIMIT_RESULT_LIST)) ? ceil($user->countActiveProjects() / LIMIT_RESULT_LIST) : $pagina + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php } else { ?>
            <div class="text-right">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_NEW_PROJECT'); ?></button>
                    <button type="button" class="btn btn-default"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_RECOVERY_DELETED'); ?></button>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php
Template::getFooter();
Database::close_db();
