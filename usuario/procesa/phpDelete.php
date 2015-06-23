<?php
require '../../require/comun.php';
$bd = new BaseDatos();
$email = Peticion::get("email");
$modelo = new ModeloUsuario($bd);
$r = $modelo->deletePorEmail($email);
$bd->closeConexion();
header("Location: ../view/viewAdministrador.php");
