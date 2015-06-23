<?php
require '../../require/comun.php';

$email=  Peticion::post("email");

$bd=new BaseDatos();
$modelo = new ModeloUsuario($bd);

$emailRecuperar=$modelo->get($email)->getEmail();

if($emailRecuperar){
$mensaje=  md5(Configuracion::PEZARANA.$emailRecuperar.Configuracion::PEZARANA);
$mensaje= Configuracion::SERVIDOR."/usuario/usuario/view/viewRecibeOlvido.php?chorizoRecupera=".$mensaje;
echo $mensaje;
}else{
    header("Location:../../index.php?op=emailnovalido");
}