<?php

require '../../require/comun.php';

$sesion = new Sesion();
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);


$email = Peticion::post("email");
$clave = Peticion::post("clave");
$nombre = Peticion::post("nombre");
$rol = Peticion::post("rol");
$activo = Peticion::post("activo");
if($activo=="on"){
    $activo=1;
}else{
    $activo=0;
}
$usuario = $modelo->get($email);

if ($usuario->getContrasenia() != $clave) {
    $usuario->setContrasenia(sha1($clave));
}
$usuario->setNombre($nombre);
if ($sesion->isAdministrador()) {
    $usuario->setRol($rol);
}

if ($usuario->getActivo() != $activo && $activo == 0) {
    $usuario->setActivo(0);
    $mensaje = md5($email . Configuracion::PEZARANA . $usuario->getContrasenia());
    $mensaje = Configuracion::SERVIDOR . "/usuario/usuario/procesa/phpActivar.php?chorizo=" . $mensaje;
    $r=Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "Clave para volver a activarse", $mensaje, Configuracion::CLAVEGMAIL);
    if($sesion->getUsuario()->getEmail()==$email){
    $sesion->close();
    $r=$modelo->update($usuario);
    header("Location:../../index.php?op=desactivado");
    return;
    }
    
} elseif ($usuario->getActivo() != $activo && $activo == 1 && $sesion->isAdministrador()) {
    $usuario->setActivo($activo);
}
$r=$modelo->update($usuario);
if($sesion->isAdministrador()){
    header("Location:../view/viewAdministrador.php?r=$r");
}else{
    header("Location:../view/viewUsuario.php?r=$r");
}