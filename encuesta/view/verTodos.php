<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        require '../../require/comun.php';
        $bd = new BaseDatos();
        /* paginacion */
        $pagina = 0;
        if (Peticion::get("pagina") != null) {
            $pagina = Peticion::get("pagina");
        }
        $resultado = Peticion::get("insert");
        $modelo = new ModeloEncuesta($bd);
        $filas = $modelo->getListPaginaEncuestas($pagina, Configuracion::RPP);
        $enlaces = Paginacion::getEnlacesPaginacion($pagina, $modelo->count(), Configuracion::RPP);
        
        /* fin paginacion */

        /* sin paginar */
        /*
          
          $modelo = new ModeloEncuesta($bd);
          $filas = $modelo->getListaEncuestas("1=1");
         */
        
        //guardamos el email de la sesion que esta iniciada
        $sesion = new Sesion();
        $nombreSesion = $sesion->getUsuario()->getNombre();
        $emailSesion = $sesion->getUsuario()->getEmail();
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Bootstrap Admin Theme</title>
        <!-- el mio propio por que si -->
        <link href="../../estilos/estilo.css" rel="stylesheet">
        <!-- Bootstrap Core CSS -->
        <link href="../../estilos/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../estilos/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../../estilos/dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../estilos/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../../estilos/bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../../estilos/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            function anadir() {
                var emailEncuesta = document.getElementById("newEmailEncuesta").value;
                var tituloEncuesta = document.getElementById("newTituloEncuesta").value;
                window.location = "../procesa/phpNuevaEncuesta.php?email=" + emailEncuesta + "&titulo=" + tituloEncuesta + "";
            }
        </script>
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php
                        echo $nombreSesion;
                        if ($sesion->isAdministrador()) {
                            echo "( Administrador )";
                        } else {
                            echo "( Usuario )";
                        }
                        ?></a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="../../usuario/procesa/phpCerrarSesion.php?nombresesion=<?php $nombreSesion ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="<?php
                                if ($sesion->isAdministrador()) {
                                    echo "../../usuario/view/viewAdministrador.php";
                                } else {
                                    echo "../../usuario/view/viewUsuario.php";
                                }
                                ?>" class="active"><i class="fa fa-home fa-fw"></i> Home Usuario</a>
                            </li>
                            <li class="divider"></li>
                            <li><h4>Encuestas</h4></li>
                            <li>
                                <a href="../view/verTodos.php" class="active"><i class="fa fa-group fa-fw"></i> Ver todas</a>
                            </li>
                            <li>
                                <a href="../view/verSoloSuyas.php" class="active"><i class="fa fa-user fa-fw"></i> Ver Solo de <?php echo $nombreSesion; ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div id="page-wrapper"style="min-height: 592px">
                <br>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Titulo</th>
                    </tr>
                    <?php
                    foreach ($filas as $indice => $objeto) {
                        ?>
                        <tr>
                            <td><?php echo $objeto->getId(); ?></td>
                            <td><?php echo $objeto->getEmail(); ?></td>
                            <td><a href="<?php
                            echo"../../pregRes/view/verTodasPR.php?idencuesta="
                            . "" . $objeto->getId();
                        ?>"><?php echo $objeto->getTitulo(); ?></a></td>

                            <td><?php
                                if ($sesion->isAdministrador() || $sesion->getUsuario()->getEmail() == $objeto->getEmail()) {
                                    echo "<a class='borrar' "
                                    . "href='../procesa/phpBorrarEncuesta.php?idencuesta=" . $objeto->getId() . "'>Borrar</a>";
                                }
                                ?></td>
                        </tr>
    <?php
}
?>   

                    <tr>
                        <td></td>
                        <td><input id="newEmailEncuesta" type="text" value="<?php echo $emailSesion ?>" disabled=""/></td>
                        <td><input id="newTituloEncuesta" type="text" value="" placeholder="Nueva Encuesta" onblur="anadir()"/></td>
                    </tr>
                    <tfoot>
                        <tr>
                            <th colspan="15">
                                <?php echo $enlaces["inicio"]; ?>
                                <?php echo $enlaces["anterior"]; ?>
                                <?php echo $enlaces["primero"]; ?>
                                <?php echo $enlaces["segundo"]; ?>
                                <?php echo $enlaces["actual"]; ?><!-- normalmente -->
<?php echo $enlaces["cuarto"]; ?>
<?php echo $enlaces["quinto"]; ?>
<?php echo $enlaces["siguiente"]; ?>
<?php echo $enlaces["ultimo"]; ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
            <script src="../../estilos/bower_components/jquery/dist/jquery.min.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="../../estilos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="../../estilos/bower_components/metisMenu/dist/metisMenu.min.js"></script>

            <!-- Morris Charts JavaScript -->
            <script src="../../estilos/bower_components/raphael/raphael-min.js"></script>
            <script src="../../estilos/bower_components/morrisjs/morris.min.js"></script>
            <script src="../../estilos/js/morris-data.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="../../estilos/dist/js/sb-admin-2.js"></script>

    </body>

</html>



