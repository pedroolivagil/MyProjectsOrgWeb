<?php

/* * **************************** */
/*   EpicTelecom.com Config    */
/* * **************************** */

define('EXPIRE', time() + (2 * 24 * 60 * 60));     // 2 dias; 24 horas; 60 min; 60 s
define('MAXFILESIZE', ini_get('upload_max_filesize') * 1024);  // En KB -> 3MB
define('MAXDIRSIZE', 20480);    // en KB -> 20MB
define('CONTRATO', 'contrato');
define('MAILTECNIC', 'telecom@epic.es');
define('_CART_', 'cesta_compra');

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
define('dbhost', 'localhost');
define('dbname', 'epic_telecom');
define('dbuser', 'adminepictelecom');
define('dbpass', 'tY5ia3&0_Ab21epicTelecom');

// '/epic-telecom' solo para ámbito local
$root = ($_SERVER['SERVER_NAME'] == 'localhost') ? '/epic-telecom' : '';
define('MAILBODY_NEWUSER', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/newuser.txt');
define('MAILBODY_NEWORDER', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/neworder.txt');
define('MAILBODY_CONTACT', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/contact.txt');
define('MAILBODY_RECOVERY', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/recovery.txt');
define('_LEGAL_FILE_', 'legal.txt');

define('_CLASS_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/classes/');
define('_PAGES_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/www/');
define('_PHP_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/www/php/');
define('_TEMP_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/temp/');
define('_FORM_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/forms/');
//define('_USER_PATH_', $_SERVER['DOCUMENT_ROOT'] . $root . '/clientes/');
define('_ROOT_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $root . '/');
define('_IMAGE_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $root . '/img/');
define('_CSS_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $root . '/css/');
define('_JS_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $root . '/js/');
define('_BSTP_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $root . '/bootstrap/');
define('_DOCS_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $root . '/docs/');
define('_USER_PATH_', 'http://' . $_SERVER['SERVER_NAME'] . $root . '/clientes/');
define('_USER_IMG_PATH_', 'img');

//session_start(); // no hace falta gracias al .htaccess
//error_reporting(E_ALL ^ E_NOTICE);
//ini_set('display_errors',1);
header('Content-type: text/html; charset=utf-8');