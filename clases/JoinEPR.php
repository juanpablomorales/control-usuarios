<?php

class JoinEPR {
    private $encuesta;
    private $pregunta;
    private $respuesta;
    
    function __construct(Encuesta $encuesta, Pregunta $pregunta, Respuesta $respuesta) {
        $this->encuesta = $encuesta;
        $this->pregunta = $pregunta;
        $this->respuesta = $respuesta;
    }
   
    public function getEncuesta() {
        return $this->encuesta;
    }

    public function getPregunta() {
        return $this->pregunta;
    }

    public function getRespuesta() {
        return $this->respuesta;
    }

    public function setEncuesta($encuesta) {
        $this->encuesta = $encuesta;
    }

    public function setPregunta($pregunta) {
        $this->pregunta = $pregunta;
    }

    public function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
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
