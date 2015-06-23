<!DOCTYPE html>
<?php
require '../../require/comun.php';
$sesion=new Sesion();
$bd = new BaseDatos();
$email = Peticion::get("email");
$modelo = new ModeloUsuario($bd);
$usuario= $modelo->get($email);
$bd->closeConexion();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../../estilos/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="../../estilos/estilo.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="container containerEdit">
            <form class="form-signin" method="POST" action="../procesa/phpUpdate.php">
            <label for="email"> Email:</label>
            <input type="hidden" name="email" value="<?php echo $usuario->getEmail() ?>" id="email" placeholder="Email"/>            
            <input type="email" name="email" value="<?php echo $usuario->getEmail() ?>" id="email" placeholder="Email" disabled/>            
            <br>
            <label for="clave"> Contraseña:</label>
            <input type="password" name="clave" value="<?php //echo $usuario->getContrasenia() ?>" id="clave" placeholder="Contraseña" required/>
            <br>
            <label for="nombre"> Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $usuario->getNombre() ?>" id="nombre" placeholder="nombre" required/>
            <br>
            <label for="activo">Activo</label>
            <input type="checkbox" name="activo" id="activo" <?php if ($usuario->getActivo()) echo "checked"; ?> />
            <br><br>
            <label for="isroot">¿Root?</label>
            <br>
            <label id="labelradio">Administrador</label>
            <input type="radio" name="rol" value="administrador" id="isroot" 
                   <?php if ($usuario->getRol()=="administrador"){ echo "checked";} ?>
                   <?php if (!$sesion->isAdministrador()) {echo "disabled";} ?>/>
            <br>
            <label id="labelradio">Usuario</label>
            <input type="radio" name="rol" value="usuario" id="isroot"  
                   <?php if ($usuario->getRol()=="usuario") { echo "checked";} ?>
                    <?php if (!$sesion->isAdministrador()) {echo "disabled";} ?> />
            <br>
            <?php
            if($sesion->isAdministrador()){
                echo "<input type='submit' value='Editar' />";
            }else{
                $nombreSesion = $sesion->getUsuario()->getEmail();
                if($usuario->getEmail()===$nombreSesion){
                    echo "<input type='submit' value='Editar' />";
                }else{
                    echo "<h1>No tienes permiso para modificar este usuario</h1>";
                }
            }
            ?>
            
        </form>
        </div>
    </body>
</html>
