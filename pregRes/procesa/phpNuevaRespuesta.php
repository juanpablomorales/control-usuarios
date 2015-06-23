<?php
require '../../require/comun.php';
//recoger datos get $texto $idrespuesta
$texto= Peticion::post("texto");
$idpregunta= Peticion::post("idpregunta");
$idencuesta=  Peticion::post("idencuesta");
$bd=new BaseDatos();
$modelo=new ModeloRespuesta($bd);

if($texto){
$respuesta= new Respuesta();
$respuesta->setIdpregunta($idpregunta);
$respuesta->setTexto($texto);
$modelo->addRespuesta($respuesta);
}
header("Location: ../view/verTodasPR.php?idencuesta=".$idencuesta);

