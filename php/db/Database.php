<?php

/**
 * Description of Database
 *
 * @author Oliva
 */
require_once('config.php');

class Database/* extends mysqli */ {

    private static $conexion;
    private static $problems;

    public static function init_db() {
        self::initConexion();
        self::setProblems(0);
    }

    public static function close_db() {
        self::$conexion = NULL;
    }

    private static function initConexion() {
        try {
            // Conectar
            self::$conexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DB, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';"));
            // Establecer el nivel de errores a EXCEPTION
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            self::addProblem();
            error_log($e->getMessage());
        }
    }

    public static function getProblems() {
        return self::$problems;
    }

    private static function setProblems($problems) {
        self::$problems = $problems;
    }

    private static function addProblem() {
        self::$problems++;
    }

    public static function findAll($table = NULL) {
        $result_final = NULL;
        if (self::check()) {
            if ($table != NULL) {
                if (($result = self::$conexion->query('SELECT * FROM ' . $table . ' WHERE flag_activo = true;', MYSQLI_USE_RESULT)) !== FALSE) {
                    $result_final = $result->fetchAll(PDO::FETCH_CLASS);
                }
            }
            return json_encode($result_final);
        }
        return NULL;
    }

    public static function execute($query = NULL) {
        $result_final = NULL;
        try {
            if (self::check()) {
                if ($query != NULL && ($result = self::$conexion->query($query, MYSQLI_USE_RESULT)) !== FALSE) {
                    $result_final = $result->fetchAll(PDO::FETCH_CLASS);
                }
            }
        } catch (PDOException $e) {
            self::addProblem();
            error_log($e->getMessage());
        }
        return $result_final;
    }

    public static function preparedQuery($query, $params = NULL) {
        $result_final = NULL;
        try {
            if (self::check()) {
                if ($query != NULL && $params != NULL) {
                    $sentencia = self::$conexion->prepare($query);
                    $sentencia->execute($params);
                    $result_final = $sentencia->fetchAll(PDO::FETCH_CLASS);
                } else if ($query != NULL && $params == NULL) {
                    $sentencia = self::$conexion->prepare($query);
                    $sentencia->execute();
                    $result_final = $sentencia->fetchAll(PDO::FETCH_CLASS);
                }
                return json_decode(json_encode($result_final, TRUE), TRUE);
            }
        } catch (PDOException $e) {
            self::addProblem();
            error_log($e->getMessage());
        }
        return $result_final;
    }

    public static function preparedQueryToJSON($query = NULL, $params = NULL) {
        $result_final = NULL;
        try {
            if (self::check()) {
                if ($query != NULL && $params != NULL) {
                    $sentencia = self::$conexion->prepare($query);
                    $sentencia->execute($params);
                    $result_final = $sentencia->fetchAll(PDO::FETCH_CLASS);
                } else if ($query != NULL && $params == NULL) {
                    $sentencia = self::$conexion->prepare($query);
                    $sentencia->execute();
                    $result_final = $sentencia->fetchAll(PDO::FETCH_CLASS);
                }
                return json_encode($result_final);
            }
        } catch (PDOException $e) {
            self::addProblem();
            error_log($e->getMessage());
        }
        return $result_final;
    }

    private static function check() {
        try {
            return self::$conexion->query('SELECT 1;');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            self::init_db();          // Don't catch exception here, so that re-connect fail will throw exception
            return FALSE;
        }
    }

    public static function begin_trans() {
        if (self::check()) {
            try {
                return self::$conexion->beginTransaction();
            } catch (PDOException $e) {
                self::addProblem();
                error_log($e->getMessage());
                return FALSE;
            }
        }
    }

    public static function commit_trans() {
        if (self::check()) {
            try {
                return self::$conexion->commit();
            } catch (PDOException $e) {
                self::addProblem();
                error_log($e->getMessage());
                return FALSE;
            }
        }
    }

    public static function rollBack_trans() {
        if (self::check()) {
            try {
                return self::$conexion->rollBack();
            } catch (PDOException $e) {
                self::addProblem();
                error_log($e->getMessage());
                return FALSE;
            }
        }
    }

    public static function insert($arrayFieldsValues, $table) {
        if (self::check()) {
            try {
                $claves = array_keys($arrayFieldsValues);
                $values = array_values($arrayFieldsValues);
                $sentencia = self::$conexion->prepare("INSERT INTO " . $table . "(" . implode(",", $claves) . ") VALUES('" . implode("','", $values) . "');");
                $sentencia->execute();
                return TRUE;
            } catch (PDOException $e) {
                self::addProblem();
                error_log($e->getMessage());
                return FALSE;
            }
        }
    }

    public static function update($table, $newValues, $params = null, $strict = true) {
        if (self::check()) {
            try {
                $set = " SET ";
                if ($newValues != null) {
                    $claves = array_keys($newValues);
                    $values = array_values($newValues);
                    $set .= "";
                    for ($x = 0; $x < count($claves); $x++) {
                        $set .= $claves[$x] . " = '" . $values[$x] . "'";
                        if ($x > 0 && $x < count($claves) - 1) {
                            $set .= ", ";
                        }
                    }
                    $where = "";
                    if ($params != null) {
                        $claves = array_keys($params);
                        $values = array_values($params);
                        $where .= "WHERE ";
                        for ($x = 0; $x < count($claves); $x++) {
                            $where .= $claves[$x] . " LIKE '" . $values[$x] . "'";
                            if ($x > 0 && $x < count($claves) - 1) {
                                if ($strict) {
                                    $where .= " AND ";
                                } else {
                                    $where .= " OR ";
                                }
                            }
                        }
                    }
                    $sentencia = self::$conexion->prepare("UPDATE " . $table . " " . $set . " " . $where . ";");
                    $sentencia->execute();
                    return TRUE;
                } else {
                    return FALSE;
                }
            } catch (PDOException $e) {
                self::addProblem();
                error_log($e->getMessage());
                return FALSE;
            }
        }
    }

    public static function delete($table, $params = null, $strict = true) {
        if (self::check()) {
            try {
                $where = "";
                if ($params != null) {
                    $claves = array_keys($params);
                    $values = array_values($params);
                    $where .= "WHERE ";
                    for ($x = 0; $x < count($claves); $x++) {
                        $where .= $claves[$x] . " LIKE '" . $values[$x] . "'";
                        if ($x > 0 && $x < count($claves) - 1) {
                            if ($strict) {
                                $where .= " AND ";
                            } else {
                                $where .= " OR ";
                            }
                        }
                    }
                }
                $sentencia = self::$conexion->prepare("DELETE FROM " . $table . " " . $where . ";");
                $sentencia->execute();
                return TRUE;
            } catch (PDOException $e) {
                self::addProblem();
                error_log($e->getMessage());
                return FALSE;
            }
        }
    }

    public static function logger($action = "", $coment = "", $user = "") {
        if (self::check()) {
            try {
                $sentencia = self::$conexion->prepare("INSERT INTO " . TABLE_ERROR_LOG . "(accion, id_usuario, comentario) VALUES('$action','$user','$coment');");
                $sentencia->execute();
            } catch (PDOException $e) {
                self::addProblem();
                error_log($e->getMessage());
            }
        }
    }

}
