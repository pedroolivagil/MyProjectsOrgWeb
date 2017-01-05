<?php
require_once('../php/Tools.php');
require_once('../php/db/Database.php');
require_once('../php/Translator.php');
Database::init_db();
$translator = new Translator('es');