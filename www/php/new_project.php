<?php

require_once('../../config.php');
error_reporting(1);
header('Content-type: text/plain; charset=UTF-8;');
if (!is_null($_POST) && Tools::isUserSession()) {
    Database::init_db();

    print_r($_POST);

    if ($_FILES) {
        print_r($_FILES);
    }

    Database::close_db();
    //header("Location: " . _ROOT_PATH_ . "user-panel");
} else {
    Tools::invalidPost();
}
