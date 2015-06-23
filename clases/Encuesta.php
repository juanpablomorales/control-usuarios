<?php

class Encuesta {

    private $id;
    private $email;
    private $titulo;

    function __construct($id=null, $email = null, $titulo = null) {
        $this->id = $id;
        $this->email = $email;
        $this->titulo = $titulo;
    }

    function set($datos, $inicio = 0) {
        $this->id= $datos[0+$inicio];
        $this->email = $datos[1 + $inicio];
        $this->titulo = $datos[2 + $inicio];
    }
    /*
    function set2($datos, $inicio = 0) {
        $prop = get_object_vars($this);()
        foreach ($prop as $key => $value) {
            if
            $resp .= '"' . $key . '":' . json_encode(htmlspecialchars_decode($value)) . ',';
        }
        $this->id= $datos[0+$inicio];
        $this->email = $datos[1 + $inicio];
        $this->titulo = $datos[2 + $inicio];
    }
    */
    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTitulo() {
        return $this->titulo;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
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
