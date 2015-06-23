<?php
require '../../require/comun.php';
$contrasenia =  Peticion::post("contrasenia");
$ChorizoRecupera=  Peticion::post("chorizoRecupera");

$bd= new BaseDatos();
$modelo= new ModeloUsuario($bd);

$contraseniaEncript=sha1($contrasenia);
$modelo->recuerdaClave($ChorizoRecupera, $contraseniaEncript);

header("Location:../../index.php?op=cambiodecontrasenia");