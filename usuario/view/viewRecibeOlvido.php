<?php
require '../../require/comun.php';
$ChorizoRecupera=  Peticion::get("chorizoRecupera");
?>
<html>
    <head>
        <link href="../../estilos/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="../../estilos/estilo.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <form action="../procesa/phpRecibirOlvido.php" method="POST">
            <h1>Introduzca su nueva contraseña:</h1>
            <input type="hidden" name="chorizoRecupera" value="<?php echo $ChorizoRecupera;?>">
            <input type="password" name="contrasenia">
            <input type="submit">
        </form>
        </div>
        
    </body>
</html>