<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link href="../../estilos/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container">

        <form class="form-signin" method="post" action="../procesa/phpNuevoUsuario.php">
        <h2 class="form-signin-heading">Please register:</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="clave" id="inputPassword" class="form-control" placeholder="Password" required>
        <br>
        <label for="inputName" class="sr-only">Name</label>
        <input type="text" name="nombre" id="inputName" class="form-control" placeholder="Name" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">New User</button>
      </form>
        <br>
              

    </div> <!-- /container -->
    </body>
</html>

