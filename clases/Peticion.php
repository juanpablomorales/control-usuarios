<?php

class Peticion {

    //leer los datos a traves de get
    public static function get($parametro, $filtrar = true) {
        if (isset($_GET[$parametro])) {
            if (is_array($_GET[$parametro])) {
                $a = array();
                foreach ($_GET[$parametro] as $key => $value) {
                    if ($filtrar) {
                        $a[] = self::filtrar($value);
                    } else {
                        $a[] = $value;
                    }
                }
                return $a;
            } else {
                if ($filtrar) {
                    return self::filtrar($_GET[$parametro]);
                }
                return $_GET[$parametro];
            }
        } else {
            return null;
        }
    }

    //leer los datos a traves de post
    public static function post($parametro, $filtrar = true) {
        if (isset($_POST[$parametro])) {
            if (is_array($_POST[$parametro])) {
                $a = array();
                foreach ($_POST[$parametro] as $key => $value) {
                    if ($filtrar) {
                        $a[] = self::filtrar($value);
                    } else {
                        $a[] = $value;
                    }
                }
                return $a;
            } else {
                if ($filtrar) {
                    return self::filtrar($_POST[$parametro]);
                }
                return $_POST[$parametro];
            }
        } else {
            return null;
        }
    }

    private static function leerArray($param, $filtrar = true) {
        $array = array();
        foreach ($param as $key => $value) {
            $array[] = $value;
        }
        return $array;
    }

    //comprobamos si es get
    public static function isGet() {
        return $_SERVER['REQUEST_METHOD'] == "GET";
    }

    //comprobamos si es post
    public static function isPost() {
        return $_SERVER['REQUEST_METHOD'] == "POST";
    }

    //comprobamos si es get
    public static function isGetV2() {
        return !self::isPostV2();
    }

    public static function isGetV3() {
        return isset($_GET);
    }

    //comprobamos si es post
    public static function isPostV2() {
        return isset($_POST);
    }

    //leer datos request 
    public static function request($nombre) {
        if (self::isGet()) {
            return self::get($nombre);
        } else if (self::isPost()) {
            return self::post($nombre);
        }
    }

    public static function requestV2($nombre) {
        if (self::isPost()) {
            $v = self::post($nombre);
            if ($v != NULL) {
                return $v;
            }
        }
        return self::get($nombre);
    }

    public static function requestV3($nombre) {
        $r = array();
        $r[] = self::get($nombre);
        $r[] = self::post($nombre);
        return $r;
    }

    public static function requestV4($nombre) {
        $v = self::get($nombre);
        if ($v == NULL) {
            return self::post($nombre);
        }
        return $v;
    }

    //ver cuantos parametros son get
    public static function getParams() {
        if (isset($_GET)) {
            return count($_GET);
        } else {
            return 0;
        }
    }

    //ver cuantos parametros son post
    public static function postParams() {
        if (isset($_POST)) {
            return count($_POST);
        } else {
            return 0;
        }
    }

    //ver cuantos parametros en total
    public static function params() {
        if (self::isGet()) {
            return self::getParams();
        }
        return self::postParams();
    }

    public static function paramsV2() {
        return self::getParams() + self::postParams();
    }

    private static function filtrar($parametro) {
        return trim(htmlspecialchars($parametro));
    }

}
