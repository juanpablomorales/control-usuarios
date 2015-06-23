<?php
require '../../require/comun.php';
$sesion= new Sesion();
$nombreSesion= Peticion::get("nombresesion");
$sesion->close();
$sesion->delete($nombreSesion);
header("Location:../../index.php");
