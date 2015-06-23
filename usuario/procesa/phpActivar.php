<?php
require '../../require/comun.php';

$chorizo=  Peticion::get("chorizo");
$bd=new BaseDatos();
$modelo= new ModeloUsuario($bd);
$r=$modelo->activa($chorizo);
if($r==1){
    header("Location:../../index.php?op=activo");
}else{
    header("Location:../../index.php?op=NOactivo");
}