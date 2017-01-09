<?php

require_once('../../config.php');
error_reporting(1);
Database::init_db();
$finalPage = 'signup-finish';

echo '<br />' . $user = $_POST['signup_email'];
echo '<br />' . Tools::encrypt($user);
echo '<br />' . $pass = $_POST['signup_password'];
echo '<br />' . $pass2 = $_POST['signup_password2'];
echo '<br />' . Tools::encrypt($pass);
echo '<br />' . $fullname = $_POST['signup_fullname'];
echo '<br />' . $birth = $_POST['signup_birthdate'];
echo '<br />' . $nif = $_POST['signup_nif'];
echo '<br />' . $phone = $_POST['signup_phone'];
echo '<br />' . $country = $_POST['signup_country'];
echo '<br />' . $state = $_POST['signup_state'];

if ($user != NULL && $pass != NULL) {
}
Database::close_db();
//header("Location: " . $finalPage);
?>
