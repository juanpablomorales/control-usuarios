<?php
require '../../require/comun.php';
$email = Peticion::post("email");
$clave = Peticion::post("clave");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->login($email, $clave);
$sesion = new Sesion();
if ($usuario == false) {
    $sesion->close;
    $bd->closeConexion();
    header("Location:../../index.php?op=Login");
} else {
    $sesion = new Sesion();
    $usuario = $modelo->get($email);
    $sesion->setUsuario($usuario);
    //echo $modelo->isAdministrador($email);
    if($modelo->isAdministrador($email)) {
        $bd->closeConexion();
        header("Location:../view/viewAdministrador.php");
    } else {
        $bd->closeConexion();
        header("Location:../view/viewUsuario.php");
    }
}