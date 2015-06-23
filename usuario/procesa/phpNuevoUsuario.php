<?php

require '../../require/comun.php';
$bd = new BaseDatos();
$email = Peticion::post("email");
$clave = Peticion::post("clave");
$nombre = Peticion::post("nombre");
$isactivo = 0;
$rol = "usuario" ;

$usuario = new Usuario($email,sha1($clave),$nombre,$rol,$isactivo);
/*
echo    $usuario->getEmail() ." - ".
        $usuario->getContrasenia() ." - ".
        $usuario->getNombre() ." - ".        
        $usuario->getActivo() ." - ".        
        $usuario->getRol(). "<br/>";
echo "<br/>";
 */  

$modelo = new ModeloUsuario($bd);
$r = $modelo->insert($usuario);
if($r){
$mensaje=  md5($usuario->getEmail().Configuracion::PEZARANA.$usuario->getContrasenia());
$mensaje= Configuracion::SERVIDOR."/usuario/usuario/procesa/phpActivar.php?chorizo=".$mensaje;
echo $mensaje;
}
//Correo::enviarGmail(Configuracion::ORIGENGMAIL, $usuario->getEmail(), "Activacion en la aplicacion de encuestas", $mensaje, Configuracion::CLAVEGMAIL);
$bd->closeConexion();
//header("Location: ../../index.php?op=insert&r=$r");
