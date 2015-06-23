<?php
require '../../require/comun.php';
$idencuesta=  Peticion::get("idencuesta");
$bd=new BaseDatos();
$modelo=new ModeloEncuesta($bd);
if($idencuesta){
$modelo->delete($idencuesta);
}
header("Location: ../view/verTodos.php");