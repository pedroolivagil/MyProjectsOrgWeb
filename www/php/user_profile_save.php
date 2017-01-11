<?php

require_once('../../config.php');
if (!is_null($_POST)) {
    header('Content-Type: text/plain; charset=UTF-8;');
    Database::init_db();
    $id = Tools::getCookie(SESSION_USUARIO_ID);
    $email = $_POST['signup_email'];
    $pass = $_POST['signup_password'];
    $pass2 = $_POST['signup_password2'];
    $fullname = $_POST['signup_fullname'];
    $birth = $_POST['signup_birthdate'];
    $nif = $_POST['signup_nif'];
    $phone = $_POST['signup_phone'];
    $country = $_POST['signup_country'];
    $state = $_POST['signup_state'];
    var_dump($_POST);
    $user = User::findById($id);
    echo "\n\n";
    var_dump($user->toArray());
    

    Database::close_db();
} else {
    Tools::invalidPost();
}