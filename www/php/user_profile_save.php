<?php

require_once('../../config.php');
if (!is_null($_POST)) {
    $finalePage = 'user-profile/save-error';
    Database::init_db();
    $id = Tools::getCookie(SESSION_USUARIO_ID);
    $pass = Tools::cryptpass($_POST['profile_password']);
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
    if ($pass == $user->getUser_pass()) {
        if ($user->update()) {
            $finalePage = 'user-profile/save-success';
        }
    }
    Database::close_db();
    header("Location: " . _ROOT_PATH_ . $finalePage);
} else {
    Tools::invalidPost();
}