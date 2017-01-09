<?php
require_once('../config.php');
if(!Tools::isUserSession()){
    header("Location: login/error");
}
Database::init_db();
Template::getHeader();
?>
<!--// BreadCrumbs //-->
<ol class="breadcrumb shadow translucid-80 width100">
    <li><a href="#"><?php echo Translator::getTextStatic('HOME_PAGE'); ?></a></li>
    <li class="active"><?php echo Translator::getTextStatic('PANEL_USER'); ?></li>
</ol>

<!--// Content //-->

<?php
Template::getFooter();
Database::close_db();
?>