<?php

require '../../require/comun.php';

$bd = new BaseDatos();
$modeloJoin = new ModeloJoinEPR($bd);
$idencuesta = Peticion::get("idencuesta");
$array = $modeloJoin->getListCompletas(0, 10, 'e.id="' . $idencuesta . '"');
$array2 = $modeloJoin->getListIncompletas(0, 10, 'e.id="' . $idencuesta . '"');
echo "<h1>encuesta completas</h1>";
$pregunta = "";
$encuesta = "";
foreach ($array as $key => $value) {
    if ($value->getEncuesta()->getId() !== $encuesta) {
        echo "<h2 class='encuesta'>" . $value->getEncuesta()->getTitulo() . "</h2>";
        $encuesta = $value->getEncuesta()->getId();
    }
    if ($value->getPregunta()->getId() !== $pregunta) {
        echo "<h3 class='pregunta'>" . $value->getPregunta()->getTexto() . "</h3>";
        $pregunta = $value->getPregunta()->getId();
    }
    echo "<h4 class='respuesta'>" . $value->getRespuesta()->getTexto() . "</h4>";
}
