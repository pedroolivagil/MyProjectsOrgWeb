<?php

require_once('../../config.php');
error_reporting(1);
header('Content-type: text/plain; charset=UTF-8;');
if (!is_null($_POST) && Tools::isUserSession()) {
    Database::init_db();
    $project_id = $_POST['newproject_id_project'];
    $project_name = $_POST['newproject_name'];
    $project_desc = $_POST['newproject_description'];
    $project_flag_finish = $_POST['newproject_flag_finish'];

    $p = new Project($project_id, $project_name, $project_desc, $project_flag_finish, 1);
    
    

    print_r($_POST);
    if (!is_null($_FILES)) {
        print_r($_FILES);
    }

    Database::close_db();
    //header("Location: " . _ROOT_PATH_ . "user-panel");
} else {
    Tools::invalidPost();
}
    