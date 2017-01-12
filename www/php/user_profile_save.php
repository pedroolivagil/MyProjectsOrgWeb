<?php

require_once('../../config.php');
if (!is_null($_POST)) {
    $finalePage = 'user-profile/save-error';
    Database::init_db();
    $id = Tools::getCookie(SESSION_USUARIO_ID);
    $pass = $_POST['profile_password'];
    $pass2 = $_POST['profile_password2'];
    $fullname = $_POST['profile_fullname'];
    $birth = $_POST['profile_birthdate'];
    $nif = $_POST['profile_nif'];
    $phone = $_POST['profile_phone'];
    $country = $_POST['profile_country'];
    $state = $_POST['profile_state'];

    $user = User::findById($id);
    $user->setFullname($fullname);
    $user->setBirth_date($birth, TRUE);
    $user->setNif($nif, TRUE);
    $user->setTelefono($phone, TRUE);
    $user->setId_pais($country, TRUE);
    $user->setPoblacion($state, TRUE);
    if ($user->update()) {
        $finalePage = 'user-profile/save-success';
    }
    Database::close_db();
    header("Location: " . _ROOT_PATH_ . $finalePage);
} else {
    Tools::invalidPost();
}