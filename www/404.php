<?php
require_once('../config.php');
Database::init_db();
Template::getHeader();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Error 404: Not Found</h3>
    </div>
    <div class="panel-body">    
        <p>The requested URL was not found on this server.</p>
        <p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p>
    </div>
</div>
<?php
Template::getFooter();
Database::close_db();
?>