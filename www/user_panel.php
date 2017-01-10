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
$proyectos = array(1, 2, 3, 4, 5);
$user = User::findById(Tools::getCookie(SESSION_USUARIO_ID));
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
                <li class="list-group-item">
                    <?php echo Translator::getTextStatic('PANEL_USER_LABEL_PROYECTOS'); ?>
                    <span class="badge"><?php echo $user->countProjects(); ?></span>
                </li>
            </ol>
            <ol class="list-group">
                <li class="list-group-item"></li>
                <li class="list-group-item"></li>
                <li class="list-group-item"></li>
            </ol>
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
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</div>
<?php
Template::getFooter();
Database::close_db();
