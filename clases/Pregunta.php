<?php

class Pregunta {
    private $id;
    private $idencuesta;
    private $texto;

    function __construct($id=null, $idencuesta = null, $texto = null) {
        $this->id = $id;
        $this->idencuesta = $idencuesta;
        $this->texto = $texto;
    }

    function set($datos, $inicio = 0) {
        $this->id=$datos[0+$inicio];
        $this->idencuesta = $datos[1 + $inicio];
        $this->texto = $datos[2 + $inicio];
    }
    public function setId($id) {
        $this->id = $id;
    }

        public function getId() {
        return $this->id;
    }

    public function getIdencuesta() {
        return $this->idencuesta;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setIdencuesta($idencuesta) {
        $this->idencuesta = $idencuesta;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
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
