<?php

require_once('../../config.php');
if (!is_null($_POST)) {
    Database::init_db();
    $finalPage = 'signup-finish';
    $user = $_POST['signup_email'];
    $pass = $_POST['signup_password'];
    $pass2 = $_POST['signup_password2'];
    $fullname = $_POST['signup_fullname'];
    $birth = $_POST['signup_birthdate'];
    $nif = $_POST['signup_nif'];
    $phone = $_POST['signup_phone'];
    $country = $_POST['signup_country'];
    $state = $_POST['signup_state'];
    if (!is_null($user) && !is_null($pass) && !is_null($fullname)) {
        if ($pass == $pass2) {
            $user = new User(Tools::encrypt($user), $user, Tools::cryptpass($pass), $fullname, $nif, $birth, $phone, $country, $state);
            if (!$user->create()) {
                $finalPage = 'signup-error';
            }
        } else {
            $finalPage = 'signup-warn';
        }
    } else {
        $finalPage = 'signup-error';
    }
    Database::close_db();
    header("Location: " . _ROOT_PATH_ . $finalPage);
} else {
    Tools::invalidPost();
}