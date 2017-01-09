<?php

require_once('../../config.php');
error_reporting(1);
Database::init_db();
$finalPage = 'signup-finish';

$user = $_POST['signup_email'];
Tools::encrypt($user);
$pass = $_POST['signup_password'];
$pass2 = $_POST['signup_password2'];
Tools::encrypt($pass);
$fullname = $_POST['signup_fullname'];
$birth = $_POST['signup_birthdate'];
$nif = $_POST['signup_nif'];
$phone = $_POST['signup_phone'];
$country = $_POST['signup_country'];
$state = $_POST['signup_state'];
if ($user != NULL && $pass != NULL) {
    if ($pass == $pass2) {
        $user = new User(Tools::encrypt($user), $user, Tools::encrypt($pass), $nif, $birth, $phone, $country, $state);
        var_dump($user->create());
    } else {
        $finalPage = 'signup-warn';
    }
} else {
    $finalPage = 'signup-error';
}
Database::close_db();
//header("Location: " . $finalPage);
?>
