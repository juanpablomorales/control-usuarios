<?php
require './clases/Peticion.php';
if (isset($_SESSION['__usuario'])) {
    header("Location:usuario/view/viewPrivado.php");
}
$op = Peticion::get("op");
$resultado = Peticion::get("r");
?>

<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Login Usuario</title>
        <link href="estilos/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if($op==="Login"){
            echo("<button class='btn btn-lg btn-warning btn-block' type='button' disabled>Login incorrecto o usuario inactivo</button>");
        }
        if($op==="insert"){
            echo("<button class='btn btn-lg btn-infoe btn-block' type='button' disabled>$resultado usuarios insertados</button>");
        }
        if($op==="activo"){
            echo("<button class='btn btn-lg btn-infoe btn-block' type='button' disabled>Activado con exito, proceda a hacer login</button>");
        }
        if($op==="NOactivo"){
            echo("<button class='btn btn-lg btn-infoe btn-block' type='button' disabled>No ha sido activado, pida o inserte la clave de nuevo</button>");
        }
        if($op==="desactivado"){
            echo("<button class='btn btn-lg btn-infoe btn-block' type='button' disabled>Usuario desactivado con exito, en su correo puede activarlo.</button>");
        }
        if($op==="emailnovalido"){
            echo("<button class='btn btn-lg btn-infoe btn-block' type='button' disabled>El email que ha introducido no existe.</button>");
        }
        if($op==="emailvalido"){
            echo("<button class='btn btn-lg btn-infoe btn-block' type='button' disabled>Se ha enviado un correo para la verificacion a la cuenta indicada.</button>");
        }
        if($op==="cambiodecontrasenia"){
            echo("<button class='btn btn-lg btn-infoe btn-block' type='button' disabled>Se ha cambiado la contraseña del usuario.</button>");
        }
        ?>
        <div class="container">

            <form class="form-signin" method="post" action="usuario/procesa/phpLogin.php">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="clave" id="inputPassword" class="form-control" placeholder="Password" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
      </form>
        <br>
        <form class="form-signin" method="post" action="./usuario/view/altaUsuario.php">
            <button class="btn btn-lg btn-info btn-block" type="submit">Register new user</button>
        </form>
        <br>     
        <a href="usuario/view/viewMandarOlvido.php">He olvidado mi clave</a>
    </div> <!-- /container -->
    
    </body>
</html>