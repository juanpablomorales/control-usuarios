<?php
require '../../require/comun.php';
//recoger datos get $email $titulo
$email= Peticion::get("email");
$titulo= Peticion::get("titulo");
$bd=new BaseDatos();
$modelo=new ModeloEncuesta($bd);

if($titulo){
$encuesta= new Encuesta();
$encuesta->setEmail($email);
$encuesta->setTitulo($titulo);
$modelo->addEncuesta($encuesta);
}
header("Location: ../view/verTodos.php");
