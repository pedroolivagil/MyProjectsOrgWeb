<?php

require_once('../../config.php');
error_reporting(1);
header('Content-type: text/plain; charset=UTF-8;');
if (!is_null($_POST) && Tools::isUserSession()) {
    Database::init_db();
    $ids = explode(EXPLODE_DELIMITER, $_POST['id']);
    foreach ($ids as $id) {
        if (!Tools::isEmpty($id)) {
            Project::setId_usuario(Tools::getCookie(SESSION_USUARIO_ID));
            $pjt = Project::findById($id);
            if ($pjt != NULL) {
                $pjt->setFlag_activo(FALSE);
                $pjt->delete();
            }
        }
    }
    Database::close_db();
    header("Location: " . _ROOT_PATH_ . "user-panel");
} else {
    Tools::invalidPost();
}
