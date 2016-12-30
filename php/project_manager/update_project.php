<?php

/* Created By: OlivaDevelop
 * Author: Pedro Oliva Gil
 * Copyright 2016
 * 
 * Añadimos el proyecto nuevo del usuario a su cuenta
 */
require_once('../Tools.php');
require_once('../db/Database.php');
$tools = new Tools();

$id_client = $_POST['id_usuario'];
if (!is_null($id_client)) {
    $problems_p = 0;
    $problems_t = 0;
    $problems_i = 0;
    $problems_p_r = 0;
    $problems_t_r = 0;
    $problems_i_r = 0;
    $project = json_decode($_POST[PROJECT], TRUE);
    $img_base64 = $_POST['img_base64'];
    $images_body_base64 = str_replace(array("[", "]"), "", $_POST['images_body_base64']);
    $image_names_body_base64 = str_replace(array("[", "]"), "", $_POST['image_names_body_base64']);
    $tarjetas = $project[NUEVO_PROYECTO_TARJETAS];
    $imagenes = $project[NUEVO_PROYECTO_IMAGENES];
    $home_dir = $project[COL_DIRECTORIO_ROOT];
    unset($project[NUEVO_PROYECTO_TARJETAS]);
    unset($project[NUEVO_PROYECTO_IMAGENES]);
    $id_proyecto = $project[COL_ID_PROYECTO];

    Database::init_db();
    Database::logger("Crear Proyecto", "Se ha iniciado la creación del proyecto.", $id_client);
    Database::begin_trans();
    if (Database::insert($project, TABLE_PROYECTO)) {
        Database::logger("Crear Proyecto", "Proyecto creado con identificador: " . $id_proyecto, $id_client);
        $relacion = array(
            COL_ID_PROYECTO => $id_proyecto,
            COL_ID_USUARIO => $id_client
        );
        if (Database::insert($relacion, TABLE_REL_PJT_USUARIO)) {
            // creamos y relacionamos las tarjetas al proyecto
            for ($x = 0; $x < count($tarjetas); $x++) {
                if (Database::insert($tarjetas[$x], TABLE_TARJETA)) {
                    $relacion = array(
                        COL_ID_PROYECTO => $id_proyecto,
                        COL_ID_TARJETA => $tarjetas[$x][COL_ID_TARJETA]
                    );
                    if (!Database::insert($relacion, TABLE_REL_PJT_TARJETA)) {
                        $problems_t_r++; // no se ha relacionado la tarjeta con el proyecto
                    }
                } else {
                    $problems_t++; // no se ha creado la tarjeta
                }
            }
            // creamos y relacionamos las imagenes al proyecto
            for ($x = 0; $x < count($imagenes); $x++) {
                if (Database::insert($imagenes[$x], TABLE_IMAGEN)) {
                    $relacion = array(
                        COL_ID_PROYECTO => $id_proyecto,
                        COL_ID_IMAGEN => $imagenes[$x][COL_ID_IMAGEN]
                    );
                    if (!Database::insert($relacion, TABLE_REL_PJT_IMAGEN)) {
                        $problems_i_r++; // no se a relacionado la imagen con el proyecto
                    }
                } else {
                    $problems_i++; // no se ha creado la imagen
                }
            }
        } else {
            $problems_p_r++; // no se ha relacionado el proyecto con el usuario
        }
    } else {
        $problems_p++; // no se ha insertado el proyecto
    }

    if ($problems_p == 0 && $problems_t == 0 && $problems_i == 0 && $problems_p_r == 0 && $problems_t_r == 0 && $problems_i_r == 0) {
        // si todo va bien, hacemos el commit
        if (Database::commit_trans()) {
            $tools->crearDirs(ROOT_USER . $id_client);
            $tools->crearDirs(ROOT_USER . $id_client . "/" . $home_dir);
            $tools->crearDirs(ROOT_USER . $id_client . "/" . $home_dir . ROOT_USER_IMG_DIR);
            $img_base64 = $_POST['img_base64'];
            $images_body_base64 = str_replace(array("[", "]"), "", $_POST['images_body_base64']);
            $image_names_body_base64 = str_replace(array("[", "]"), "", $_POST['image_names_body_base64']);
            if ($img_base64 != "" and $img_base64 != null) {
                $tools->createImage(ROOT_USER . $id_client . "/" . $home_dir . "/" . $project[HOME_IMG], $img_base64);
            } else {
                Database::logger("Home Image", "No se pudo insertar la imagen de cabecera de proyecto", $id_client);
            }
            if ($images_body_base64 != "" and $images_body_base64 != null) {
                $arrayImgBase64 = explode(",", $images_body_base64);
                $names = explode(",", $image_names_body_base64);
                for ($z = 0; $z < count($arrayImgBase64); $z++) {
                    $img = trim($arrayImgBase64[$z]);
                    $name = trim($names[$z]);
                    $tools->createImage(ROOT_USER . $id_client . "/" . $home_dir . ROOT_USER_IMG_DIR . $name, $img);
                }
            }
            Database::logger("Crear Proyecto", "Proyecto creado y asignado correctamente: " . $id_proyecto, $id_client);
            $retorno = TRUE;
        } else {
            Database::rollBack_trans();
            Database::logger("Crear Proyecto; p_p: " . $problems_p . "; p_p_r: " . $problems_p_r . "; p_t: " . $problems_t . "; p_t_r: " . $problems_t_r . "; p_i: " . $problems_i . "; p_i_r: " . $problems_i_r, "Ocurrió algún problema al crear/asignar el proyecto. Se ha deshecho los cambios.", $id_client);
            $retorno = FALSE;
        }
    } else {
        Database::rollBack_trans();
        Database::logger("Crear Proyecto; p_p: " . $problems_p . "; p_p_r: " . $problems_p_r . "; p_t: " . $problems_t . "; p_t_r: " . $problems_t_r . "; p_i: " . $problems_i . "; p_i_r: " . $problems_i_r, "Se ha deshecho los cambios.", $id_client);
        $retorno = FALSE;
    }
    Database::close_db();
} else {
    Tools::invalidPost($_POST['app']);
    $retorno = FALSE;
}
echo $retorno;
?>