<?php

/**
 * Description of Tools
 *
 * @author Oliva
 */

class Tools {

    /*public $LOGGER_FILES = SERVER_ROOT . "/logs/files_log.txt";
    public $LOGGER_IMAGE = SERVER_ROOT . "/logs/image_log.txt";
    public $LOGGER_TESTS = SERVER_ROOT . "/logs/tests_log.txt";
    public $LOGGER_PROJECT = SERVER_ROOT . "/logs/project_log.txt";
    private $user;*/

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

    /*public function testLog($str) {
        $this->logger($this->LOGGER_TESTS, $str);
    }*/

    /*public function logger($logger, $str) {
        if (is_file($logger)) {
            chmod($logger, 0777);
            $fp = fopen($logger, 'a+');
            fwrite($fp, date("Y/m/d H-i-s") . " (" . $this->getUser() . ")" . ": '" . $str . "'" . PHP_EOL);
            fclose($fp);
            chmod($logger, 0744);
        }
    }*/

    /*public function setUser($user) {
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }*/

    public static function encrypt($string) {
        return md5(CRYPT_KEY . '' . $string);
    }

    public static function invalidPost($isApp) {
        if ($isApp) {
            echo '{}';
        } else {
            header("Location: " . SERVER_ROOT . "/404");
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
    
    public static function login($user, $pass, $auto = FALSE) {
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
            $time = ($auto) ? EXPIRE * 15 * 12 : EXPIRE; // 1 año o 2 días
            self::setCookie(SESSION_USUARIO, $usuario[0], $time);
        }
    }

    public static function chmodAll($url) {
        return chmod($url, 0777);
    }

    public static function chmodDef($url) {
        return chmod($url, 0755);
    }

    public static function setCookie($id, $value, $time = EXPIRE) {
        setcookie($id, $value, $time, '/');
    }

    public static function getCookie($id) {
        return $_COOKIE[$id];
    }

    public static function isUserSession() {
        return !is_null(self::getCookie(SESSION_USUARIO));
    }

    public static function getStyleAlert($type) {
        $style = "alert-";
        switch ($type) {
            case 'error':
                $style .= "danger";
                break;
            case 'success':
                $style .= "success";
                break;
            case 'warning':
                $style .= "warning";
                break;
            case 'info':
            default:
                $style .= "info";
                break;
        }
        return $style;
    }

}

?>