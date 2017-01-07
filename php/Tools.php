<?php

session_start();
error_reporting(0);

class Tools {

    public $LOGGER_FILES = SERVER_ROOT . "/logs/files_log.txt";
    public $LOGGER_IMAGE = SERVER_ROOT . "/logs/image_log.txt";
    public $LOGGER_TESTS = SERVER_ROOT . "/logs/tests_log.txt";
    public $LOGGER_PROJECT = SERVER_ROOT . "/logs/project_log.txt";
    private $user;

    public function crearDirs($var) {
        if (is_dir($var)) {
            return chmod($var, 0777);
        } else {
            return mkdir($var, 0777);
        }
    }

    public function eliminarDir($url) {
        $abrir = opendir($url);
        while ($ficheros = readdir($abrir)) {
            if (($ficheros != '.')and ( $ficheros != '..')) {
                if (is_dir($url . '/' . $ficheros)) {
                    eliminarDir($url . '/' . $ficheros);
                } else {
                    unlink($url . '/' . $ficheros);
                }
                rmdir($url . '/' . $ficheros);
            }
        }
        closedir($abrir);
    }

    public function createFile($urlPath, $obj) {
        chmod($urlPath, 0777);
        $fp = fopen($urlPath, 'w');
        fwrite($fp, $obj . PHP_EOL);
        if (fclose($fp)) {
            //$this->logger($this->LOGGER_FILES, $urlPath . ": File created/edited.");
            return true;
        } else {
            //$this->logger($this->LOGGER_FILES, $urlPath . ": File NOT created.");
            return false;
        }
    }

    public function readFile($urlPath) {
        chmod($urlPath, 0777);
        return file_get_contents($urlPath);
    }

    public function createImage($urlPath, $img) {
        chmod($urlPath, 0777);
        $img = base64_decode($img);
        $fp = fopen($urlPath, 'w');
        fwrite($fp, $img);
        if (fclose($fp)) {
            //$this->logger($this->LOGGER_IMAGE, $urlPath . ": Image created.");
            return true;
        } else {
            //$this->logger($this->LOGGER_IMAGE, $urlPath . ": Image NOT created.");
            return false;
        }
    }

    public function testLog($str) {
        $this->logger($this->LOGGER_TESTS, $str);
    }

    public function logger($logger, $str) {
        if (is_file($logger)) {
            chmod($logger, 0777);
            $fp = fopen($logger, 'a+');
            fwrite($fp, date("Y/m/d H-i-s") . " (" . $this->getUser() . ")" . ": '" . $str . "'" . PHP_EOL);
            fclose($fp);
            chmod($logger, 0744);
        }
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }

    public static function encrypt($string) {
        return md5(CRYPT_KEY . '' . $string);
    }

    public static function invalidPost($isApp) {
        if ($isApp) {
            echo '{}';
        } else {
            //header("Location: " . SERVER_ROOT . "/404.html");
            Tools::navigate("404");
        }
    }

    public static function cleanChars($string) {
        $char = array(',', '.', ';', ':', '-', '/', '+', '-', '*', '<', '>', 'Âº', 'Âª', '\\', '&', '!', '"', 'Â·', '$', '%', '(', ')', '=', '\'', '?', 'Â¡', 'Â¿', '|', '@', '#', '~', 'â‚¬', 'Â¬', '{', '}', '[', ']', 'Ã§', '`', 'Â´');
        $char_rpl = '';
        return trim(str_replace($char, $char_rpl, $string));
    }

    public static function crearIdUnico($leng) {
        return substr(md5(microtime()), 0, $leng);
    }

    public static function navigate($page, $string = NULL, $type_error = NULL) {
        echo "<script>";
        echo "navigate('$page');";
        if ($string != NULL) {
            $type_error = ($type_error == NULL) ? $type_error : 'info';
            echo "showAlertClosable('$string','$type_error');";
        }
        echo "</script>";
    }

    public static function navigateLogin($string = NULL, $type_error = NULL) {
        Tools::navigate("templates/login", $string, $type_error);
    }

    public static function login($user, $pass) {
        $err = 0;
        $id = Tools::encrypt($user);
        $params = array(
            COL_ID_USUARIO => $id
        );
        Database::init_db();
        $usuario = Database::preparedQuery(UsuarioFindById, $params);
        Database::close_db();
        $pwd = Tools::encrypt($pass);
        if ($usuario != NULL) {
            $user_pass = $usuario[0]['user_pass'];
            if ($pwd != $user_pass) {
                $err++;
            }
        } else {
            $err++;
        }
        if ($err == 0) {
            $_SESSION[SESSION_USUARIO] = $usuario[0];
            $_SESSION[SESSION_AUTOLOGIN] = $usuario[0];
            Tools::navigate("templates/home");
        } else {
            Tools::navigateLogin(Translator::getTextStatic("LOGIN_PAGE_ERROR_LOGIN"), "danger");
        }
    }

    public static function logout() {
        unset($_SESSION[SESSION_USUARIO]);
        unset($_SESSION[SESSION_AUTOLOGIN]);
    }

    public static function session_exists() {
        return isset($_SESSION[SESSION_USUARIO]);
    }

}

?>