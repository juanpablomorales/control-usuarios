<?php
/* Constructor
 * Funcion set
 * Funcion get
 * Funcion delete
 * Funcion close
 */
class Sesion {

    private static $acceso = false;

    function __construct($nombre = "") {
        if (self::$acceso === false) {
            if ($nombre != "") {
                session_name($nombre);
            }
            session_start();
            self::$acceso = true;
        }
    }

    function get($nombre) {
        if (isset($_SESSION[$nombre])) {
            return $_SESSION[$nombre];
        } else {
            return null;
        }
    }

    function getUsuario() {
        return $this->get("__usuario");
    }

    function set($nombre, $valor) {
        $_SESSION[$nombre] = $valor;
    }

    function setUsuario(Usuario $valor) {
        $this->set("__usuario", $valor);
    }

    function isAutentificado() {
        return $this->get("__usuario") != null;
    }

    function autentificado($destino = "index.php") {
        if (!$this->isAutentificado()) {
            $this->redirigir($destino);
        }
    }

    function isAdministrador() {
        if ($this->isAutentificado()) {
            $u = $this->getUsuario();
            return $u->getRol() === "administrador";
        }
        return false;
    }

    function administrador($destino = "index.php") {
        if (!$this->isAdministrador()) {
            $this->redirigir($destino);
        }
    }

    function redirigir($destino = "index.php") {
        header("location $destino");
        exit();
    }

    function delete($nombre) {
        unset($_SESSION[$nombre]);
    }

    function close() {
        session_unset();
        session_destroy();
    }

}
