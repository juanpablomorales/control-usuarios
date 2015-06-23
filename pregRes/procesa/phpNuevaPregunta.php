<?php
require '../../require/comun.php';
//recoger datos get $texto $idencuesta
$texto= Peticion::post("texto");
$idencuesta= Peticion::post("idencuesta");
$bd=new BaseDatos();
$modelo=new ModeloPregunta($bd);

if($texto){
$pregunta= new Pregunta();
$pregunta->setIdencuesta($idencuesta);
$pregunta->setTexto($texto);
$modelo->addPregunta($pregunta);
}
header("Location: ../view/verTodasPR.php?idencuesta=".$idencuesta);
