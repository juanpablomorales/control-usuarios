<?php

class ModeloJoinEPR {

    private $bd;

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function count($condicion = "") {
        $this->bd->setConsulta("select count(*) from encuesta e join pregunta p on e.id=p.idencuesta join respuesta r"
                . "on p.idencuesta=r.idpregunta");
        $fila = $this->bd->obtenerFila();
        return $fila[0];
    }

    function getListCompletas($pagina = 0, $rpp = 10, $condicion = "1=1", $orderby = "1") {
        $pos = $pagina * $rpp;
        $sql = "select * from encuesta e join pregunta p on e.id=p.idencuesta join respuesta r on p.id=r.idpregunta where $condicion;";
        $r = $this->bd->setConsulta($sql);
        $respuesta = array();
        //$cont=0;
        while ($fila = $this->bd->getFila()) {
            $objeto1 = new Encuesta();
            $objeto1->set($fila);
            $objeto2 = new Pregunta();
            $objeto2->set($fila, 3);
            $objeto3 = new Respuesta();
            $objeto3->set($fila, 6);
            $respuesta[] = new JoinEPR($objeto1, $objeto2, $objeto3);
            /*
              $respuesta[$cont][0] = $objeto1;
              $respuesta[$cont][1] = $objeto2;
              $respuesta[$cont][2] = $objeto3;
              $cont++;

             */
        }
        return $respuesta;
    }
    function getListIncompletas($pagina = 0, $rpp = 10, $condicion = "1=1", $orderby = "1") {
        $pos = $pagina * $rpp;
        $sql = "select * from encuesta e left join pregunta p on e.id=p.idencuesta left join respuesta r on p.id=r.idpregunta where $condicion;";
        $r = $this->bd->setConsulta($sql);
        $respuesta = array();
        //$cont=0;
        while ($fila = $this->bd->getFila()) {
            $objeto1 = new Encuesta();
            $objeto1->set($fila);
            $objeto2 = new Pregunta();
            $objeto2->set($fila, 3);
            $objeto3 = new Respuesta();
            $objeto3->set($fila, 6);
            $respuesta[] = new JoinEPR($objeto1, $objeto2, $objeto3);
            /*
              $respuesta[$cont][0] = $objeto1;
              $respuesta[$cont][1] = $objeto2;
              $respuesta[$cont][2] = $objeto3;
              $cont++;

             */
        }
        return $respuesta;
    }

}
