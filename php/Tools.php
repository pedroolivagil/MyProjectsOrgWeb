<?php

/**
 * Description of Tools
 *
 * @author Oliva
 */
class Tools {

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
            return true;
        } else {
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
            return true;
        } else {
            return false;
        }
    }

    public static function encrypt($string) {
        return md5(CRYPT_KEY . '' . $string);
    }

    public static function cryptpass($str) {
        // encripta un string con codificación blowfish
        if (CRYPT_BLOWFISH == 1) {
            return crypt($str, '$2a$07$MiProJectSoRG52570b6fcf2eb$');
        }
    }

    public static function invalidPost($isApp = FALSE) {
        if ($isApp) {
            echo '{}';
        } else {
            header("Location: " . _ROOT_PATH_ . "404");
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
        $params = array(
            COL_ID_USUARIO => self::encrypt($user)
        );
        $usuario = Database::preparedQuery(UsuarioFindById, $params);
        $pwd = self::cryptpass($pass);
        if ($usuario != NULL) {
            $user_pass = $usuario[0]['user_pass'];
            if ($pwd != $user_pass) {
                $err++;
            }
            if($usuario[0][COL_FLAG_ACTIVO] == 0){
                $err++;
            }
        } else {
            $err++;
        }
        if ($err == 0) {
            $time = ($auto) ? EXPIRE * 15 * 12 : EXPIRE; // 1 año o 2 días
            self::setCookie(SESSION_USUARIO_ID, $usuario[0][COL_ID_USUARIO], $time);
            self::setCookie(SESSION_USUARIO_NAME, $usuario[0]['fullname'], $time);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function logout() {
        if (!is_null(self::getCookie(SESSION_USUARIO_ID)) && !empty(self::getCookie(SESSION_USUARIO_ID))) {
            self::setCookie(SESSION_USUARIO_ID, null, 0);
            self::setCookie(SESSION_USUARIO_NAME, null, 0);
        }
    }

    public static function chmodAll($url) {
        return @chmod($url, 0777);
    }

    public static function chmodDef($url) {
        return @chmod($url, 0755);
    }

    public static function setCookie($id, $value, $time = EXPIRE) {
        setcookie($id, $value, $time, '/');
    }

    public static function getCookie($id) {
        return $_COOKIE[$id];
    }

    public static function isUserSession() {
        return !is_null(self::getCookie(SESSION_USUARIO_ID));
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

    public static function cutString($string, $start, $length = NULL) {
        return substr($string, $start, $length);
    }

    public static function cutOutput($str, $limite) {
        $longWeight = strlen($str);
        if ($longWeight > $limite) {
            $frase = substr($str, 0, $limite) . '...';
        } else {
            $frase = $str;
        }
        return $frase;
    }

    public static function toNull($string) {
        return (strlen($string) > 0) ? $string : NULL;
    }

}

?>