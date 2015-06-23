<?php

class ModeloPregunta {

    private $bd;
    private $tabla = "pregunta";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function addPregunta(Pregunta $pregunta) {
        $sql = "insert into $this->tabla values (null, :idencuesta, :texto);";
        $parametros["idencuesta"] = $pregunta->getIdencuesta();
        $parametros["texto"] = $pregunta->getTexto();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
    }

    function deletePregunta($idPregunta) {
        $sql = "delete from $this->tabla where id=:id;";
        $parametros["id"] = $idPregunta;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    //le paso el id y me devuelve la encuesta completa
    function getPregunta($idPregunta) {
        $sql = "select * from $this->tabla where id=:id;";
        $parametros["id"] = $idPregunta;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $pregunta = new Pregunta();
            $pregunta->set($this->bd->getFila());
            return $pregunta;
        }
        return null;
    }

    function getListaPreguntas($condicion) {
        $list = array();
        $sql = "select * from $this->tabla where $condicion;";
        $r = $this->bd->setConsulta($sql);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $pregunta = new Pregunta();
                $pregunta->set($fila);
                $list[] = $pregunta;
            }
        } else {
            return null;
        }
        return $list;
    }

    function countPreguntas($idencuesta) {
        $sql = "select * from $this->tabla where idencuesta=:idencuesta;";
        $parametros["idencuesta"] = $idencuesta;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $contador = 0;
            while ($fila = $this->bd->getFila()) {
                $contador++;
            }
        } else {
            return null;
        }
        return $contador;
    }

}
