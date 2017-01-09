<?php
require_once('config.php');
Database::init_db();
Template::getHeader();
?>
<div class="container">
    <p class="well">Home page</p>
</div>
<?php
Template::getFooter();
Database::close_db();
?>
