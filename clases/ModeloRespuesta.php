<?php

class ModeloRespuesta{
    private $bd;    
    private $tabla = "respuesta";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
   
    function addRespuesta(Respuesta $respuesta) {
        $sql = "insert into $this->tabla values (null, :idpregunta, :texto);";
        $parametros["idpregunta"] = $respuesta->getIdpregunta();
        $parametros["texto"] = $respuesta->getTexto();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        }

    function deleteRespuesta($id) {
        $sql = "delete from $this->tabla where id=:id;";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    //le paso el id y me devuelve la encuesta completa
    function getRespuesta($id) {
        $sql = "select * from $this->tabla where id=:id;";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $respuesta = new Respuesta();
            $respuesta->set($this->bd->getFila());
            return $respuesta;
        }
        return null;
    }
    function getListaRespuestas($condicion) {
        $list = array();
        $sql = "select * from $this->tabla where $condicion ;";
        $r = $this->bd->setConsulta($sql);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $respuesta = new Respuesta();
                $respuesta->set($fila);
                $list[] = $respuesta;
            }
        } else {
            return null;
        }
        return $list;
    }
     function countRespuestas($idpregunta) {
        $sql = "select * from $this->tabla where idpregunta=:idpregunta;";
        $parametros["idpregunta"] = $idpregunta;
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
