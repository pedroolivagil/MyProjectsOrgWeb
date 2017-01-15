<?php

// Constantes
define("SERVER_ROOT", "http://localhost/myprojectsorg");
//define("SERVER_ROOT", $_SERVER['HTTP_HOST']);

define("USUARIO", "usuario");
define("PROJECT", "project");

define("PAISES", "paises");
define("NUEVO_PROYECTO_IMAGENES", "project_images");
define("NUEVO_PROYECTO_TARJETAS", "project_targets");
define("PROYECTOS_USUARIO", "proyectos_usuario");
define("TARJETAS_PROYECTO", "tarjetas_proyecto");
define("IMAGENES_PROYECTO", "imagenes_proyecto");
define("IMG_BASE64", "img_base64");
define("IMAGES_BODY_BASE64", "images_body_base64");
define("IMAGE_NAMES_BODY_BASE64", "image_names_body_base64");
define("ROOT_USER", "../../clients/");
define("ROOT_USER_IMG_DIR", "/img/");

define("TABLE_PROYECTO", "proyecto");
define("TABLE_TARJETA", "tarjeta");
define("TABLE_IMAGEN", "imagen");
define("TABLE_USUARIO", "usuario");
define("TABLE_REL_PJT_IMAGEN", "rel_proyecto_imagen");
define("TABLE_REL_PJT_TARJETA", "rel_proyecto_tarjeta");
define("TABLE_REL_PJT_USUARIO", "rel_proyecto_usuario");
define("TABLE_ERROR_LOG", "error_log");

define("COL_ID_USUARIO", "id_usuario");
define("COL_ID_PROYECTO", "id_proyecto");
define("COL_ID_TARJETA", "id_tarjeta");
define("COL_ID_IMAGEN", "id_imagen");
define("COL_FLAG_ACTIVO", "flag_activo");
define("COL_NOMBRE", "nombre");
define("COL_DIRECTORIO_ROOT", "directorio_root");
define("HOME_IMG", "home_image");

// Queries
define("ParametroByEtiqueta", "SELECT texto FROM parametros WHERE etiqueta LIKE :label AND id_idioma = :id_idioma");
define("PaisesFindAll", "SELECT * FROM paises ORDER BY nombre ASC");
define("PaisesFindByISO", "SELECT * FROM paises WHERE iso LIKE :iso");
define("PaisesFindById", "SELECT * FROM paises WHERE id = :id_pais");
define("UsuarioFindById", "SELECT u.* FROM usuario u WHERE u.id_usuario = :id_usuario");
define("ProyectoFindById", "SELECT p.* FROM proyecto p JOIN rel_proyecto_usuario rpu ON rpu.id_proyecto = p.id_proyecto JOIN usuario u ON rpu.id_usuario = u.id_usuario WHERE u.id_usuario = :id_usuario AND rpu.id_proyecto = :id_proyecto");
define("ProyectosFindAllById", "SELECT p.* FROM proyecto p JOIN rel_proyecto_usuario rpu ON rpu.id_proyecto = p.id_proyecto JOIN usuario u ON rpu.id_usuario = u.id_usuario WHERE u.id_usuario = :id_usuario");
define("TarjetasFindAllById", "SELECT t.* FROM tarjeta t JOIN rel_proyecto_tarjeta rpt ON rpt.id_tarjeta = t.id_tarjeta JOIN rel_proyecto_usuario rpu ON rpt.id_proyecto = rpu.id_proyecto JOIN usuario u ON rpu.id_usuario = u.id_usuario WHERE u.id_usuario = :id_usuario AND rpu.id_proyecto = :id_proyecto");
define("ImagenesFindAllById", "SELECT i.* FROM imagen i JOIN rel_proyecto_imagen rpi ON rpi.id_imagen = i.id_imagen JOIN rel_proyecto_usuario rpu ON rpi.id_proyecto = rpu.id_proyecto JOIN usuario u ON rpu.id_usuario = u.id_usuario WHERE u.id_usuario = :id_usuario AND rpu.id_proyecto = :id_proyecto");