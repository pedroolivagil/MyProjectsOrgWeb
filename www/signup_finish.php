<?php
require_once('../config.php');
Database::init_db();
Template::getHeader();
$breads = array(Translator::getTextStatic('PANEL_USER') => "");
Template::getBreadCrumbs($breads);
?>

<!--// Content //-->
<div class="well">SignUp Ok</div>
<?php
Template::getFooter();
Database::close_db();
?>