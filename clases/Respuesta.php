<?php

class Respuesta {
    private $id;
    private $idpregunta;
    private $texto;

    function __construct($id=null,$idpregunta = null, $texto = null) {
        $this->id = $id;
        $this->idpregunta = $idpregunta;
        $this->texto = $texto;
    }

    function set($datos, $inicio = 0) {
        $this->id=$datos[0+$inicio];
        $this->idpregunta = $datos[1 + $inicio];
        $this->texto = $datos[2 + $inicio];
    }
    public function setId($id) {
        $this->id = $id;
    }

        public function getId() {
        return $this->id;
    }

    public function getIdpregunta() {
        return $this->idpregunta;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setIdpregunta($idpregunta) {
        $this->idpregunta = $idpregunta;
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
