<?php

require_once('../../config.php');
if (!is_null($_POST)) {
    Database::init_db();
    $user = $_POST['login_email'];
    $pass = $_POST['password_login'];
    if ($user != NULL && $pass != NULL) {
        Tools::login($user, $pass);
    }
    Database::close_db();
    header("Location: " . _ROOT_PATH_ . "user-panel");
} else {
    Tools::invalidPost();
}
