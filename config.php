<?php

/* * ************************* */
/*   MyProjectsOrg.com Config  */
/* * ************************* */

define('EXPIRE', time() + (2 * 24 * 60 * 60));     // 2 dias; 24 horas; 60 min; 60 s
define('MAXFILESIZE', ini_get('upload_max_filesize') * 1024);  // En KB -> 3MB
define('MAXDIRSIZE', 524288);    // en KB -> 512MB
define('EMPRESA', 'OlivaDevelo S.L.');
define('MAILTECNICO', 'olivadevelop@gmail.com');
define('LOCALE', 'es');
define('LIMIT_RESULT_LIST', 3);
define('LIMIT_PAGINATOR_NUMS', 10);
define('HEIGHT_THUMB_VIEW_PJT', 57);

// PDIGen Constants
define('DOWNLOAD', 'D');
define('SHOWBROWSER', 'I');
define('SAVETOURL', 'F');
define('TOSTRING', 'S');
define('FONTDEFAULT', 12);
define('FONTEXTRA', 14);
define('FONTCOLORDEF', 50);
define('FONTCOLOR120', 180);

// DB Constants
define('DB_HOST', 'localhost');
define('DB_USER', 'admin');
define('DB_PASSWORD', '1234');
define('DB_DB', 'myprojectsorg');
define('PORT', $_SERVER['SERVER_PORT']);

define('CRYPT_KEY', 'myprojectorganizerolivadevelop');
define('SESSION_USUARIO_ID', 'id_usuario');
define('SESSION_USUARIO_NAME', 'name_usuario');
define('SESSION_AUTOLOGIN', 'autologin');

// '/myprojectsorg' solo para ámbito local
$port = ':' . PORT;
$root = ($_SERVER['SERVER_NAME'] == 'localhost') ? '/myprojectsorg' : '';
define('MAILBODY_NEWUSER', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/newuser.txt');
define('MAILBODY_NEWORDER', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/neworder.txt');
define('MAILBODY_CONTACT', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/contact.txt');
define('MAILBODY_RECOVERY', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/recovery.txt');
define('_LEGAL_FILE_', 'legal.txt');

define('_CLASS_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/php/');
define('_PAGES_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/www/');
define('_PHP_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/www/php/');
define('_TEMP_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/temp/');
define('_FORM_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/');
//define('_USER_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/clients/');
define('_ROOT_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $port . $root . '/');
define('_IMAGE_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $port . $root . '/img/');
define('_CSS_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $port . $root . '/css/');
define('_JS_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $port . $root . '/js/');
define('_DOCS_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $port . $root . '/docs/');
define('_USER_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $port . $root . '/clients/');
define('_USER_IMG_PATH_', 'img');

//session_start(); // no hace falta gracias al .htaccess
//ini_set('display_errors',1);
header('Content-type: text/html; charset=utf-8');
require_once(_CLASS_PATH_ . 'Tools.php');
require_once(_CLASS_PATH_ . 'db/Database.php');
require_once(_CLASS_PATH_ . 'Translator.php');
require_once(_CLASS_PATH_ . 'Template.php');
require_once(_CLASS_PATH_ . 'BasicMethods.php');
require_once(_CLASS_PATH_ . 'BasicMethodsEntities.php');
require_once(_CLASS_PATH_ . 'EntityManager.php');
require_once(_CLASS_PATH_ . 'PersistenceManager.php');
// Persistence
require_once(_CLASS_PATH_ . 'entities/User.php');
require_once(_CLASS_PATH_ . 'entities/Project.php');
require_once(_CLASS_PATH_ . 'entities/TargetProject.php');
require_once(_CLASS_PATH_ . 'entities/ImageProject.php');
error_reporting(0);
?>