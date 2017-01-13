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
$totalProjects = $user->getAllProjects();
$pagina = (!is_null($_REQUEST['pagina'])) ? $_REQUEST['pagina'] : 1;
?>
<!--// Content //-->
<?php include_once(_PHP_PATH_ . 'viewuser.php'); ?>

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
                        <?php
                    }
                }
                ?>
            </div>
        <?php } else { ?>
            <p><?php echo Translator::getTextStatic('PANEL_USER_LABEL_NO_HAVE_PROJECTS'); ?></p>
        <?php } ?>
    </div>
    <div class="panel-footer">
        <?php if ($user->countProjects() > 0) { ?>
            <!--// Paginador //-->
            <div class="text-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li <?php echo ($pagina <= 1) ? 'class="disabled"' : '' ?>>
                            <a href="<?php echo _ROOT_PATH_; ?>user-panel/pag/<?php echo ($pagina - 1 < 1) ? 1 : $pagina - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($x = 1; $x <= ceil($user->countProjects() / LIMIT_RESULT_LIST); $x++) { ?>
                            <li <?php echo ($pagina == $x) ? 'class="active"' : '' ?>><a href="<?php echo _ROOT_PATH_; ?>user-panel/pag/<?php echo $x; ?>"><?php echo $x; ?></a></li>
                        <?php } ?>
                        <li <?php echo ($pagina >= ceil($user->countProjects() / LIMIT_RESULT_LIST)) ? 'class="disabled"' : '' ?>>
                            <a href="<?php echo _ROOT_PATH_; ?>user-panel/pag/<?php echo ($pagina + 1 > ceil($user->countProjects() / LIMIT_RESULT_LIST)) ? ceil($user->countProjects() / LIMIT_RESULT_LIST) : $pagina + 1; ?>" aria-label="Next">
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
