<?php

class Usuario {

    private $email;
    private $contrasenia;
    private $nombre;
    private $rol;
    private $activo;

    function __construct($email = null, $contrasenia = null, $nombre = null, $rol = 'usuario', $activo = 0) {
        $this->email = $email;
        $this->contrasenia = $contrasenia;
        $this->nombre = $nombre;
        $this->activo = $activo;
        $this->rol = $rol;
    }

    function set($datos, $inicio = 0) {
        $this->email = $datos[0 + $inicio];
        $this->contrasenia = $datos[1 + $inicio];
        $this->nombre = $datos[2 + $inicio];
        $this->rol = $datos[3 + $inicio];
        $this->activo = $datos[4 + $inicio];
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    public function getJSON() {
        $prop = get_object_vars($this);
        $resp = '{';
        foreach ($prop as $key => $value) {
            $resp .= '"' . $key . '":' . json_encode(htmlspecialchars_decode($value)) . ',';
        }
        $resp = substr($resp, 0, -1) . "}";
        return $resp;
    }

}
