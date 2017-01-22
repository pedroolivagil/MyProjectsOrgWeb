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

    // function __construct($id_proyecto, $nombre, $description = NULL, $flag_finish = NULL, $flag_activo = NULL, 
    // $fecha_creacion = NULL, $fecha_actualizacion = NULL, $directorio_root = NULL, $home_image = NULL, 
    // $tarjetas = NULL, $imagenes = NULL) {

    $p = new Project($project_id, $project_name, $project_desc, $project_flag_finish, 1);

    // tarjetas
    $tarjet_til = $_POST['newproject_target_label'];
    $tarjet_val = $_POST['newproject_target_value'];
    if ((count($tarjet_til) > 0 && count($tarjet_val) > 0) && (count($tarjet_til) == count($tarjet_val))) {
        $tarjetas = array();
        for ($x = 0; $x < count($tarjet_til); $x++) {
            $t = new TargetProject($p->getId_proyecto(), Tools::generateUUID(UUID_LENGHT), $tarjet_til[$x], $tarjet_val[$x], 1);
            array_push($tarjetas, $t);
        }
        $p->setTarjetas($tarjetas);
    }

    // imagenes
    if (!is_null($_FILES)) {
        $imagenes = array();
        if (!is_null($_FILES['header_img'])) {
            $size = getimagesize($_FILES['header_img']['tmp_name']);
            $image = new ImageProject($p->getId_proyecto(), Tools::generateUUID(UUID_LENGHT_XL), $_FILES['header_img']['tmp_name'], NULL, $size[0], $size[1], NULL, 1, 1);
            array_push($imagenes, $image);
        }
        if (!is_null($_FILES['projectImg'])) {
            $pjtImages = $_FILES['projectImg'];
            $countImg = count($_FILES['projectImg']['name']);
            for ($x = 0; $x < $countImg; $x++) {
                $size = getimagesize($pjtImages['tmp_name'][$x]);
                $image = new ImageProject($p->getId_proyecto(), Tools::generateUUID(UUID_LENGHT), $pjtImages['tmp_name'][$x], NULL, $size[0], $size[1], NULL, 1, 0);
                array_push($imagenes, $image);
            }
        }
        $p->setImagenes($imagenes);
    }

    print_r($p);
    Database::close_db();
    //header("Location: " . _ROOT_PATH_ . "user-panel");
} else {
    Tools::invalidPost();
}
    