<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        require '../../require/comun.php';
        // lo leeria por post
        $idencuesta = Peticion::get("idencuesta");
        $sesion = new Sesion();
        $bd = new BaseDatos();
        //$modeloEncuesta = new ModeloEncuesta($bd);
        //$tituloEncuesta= $modeloEncuesta->get($idencuesta)->getTitulo();
        //$filas = $modelo->getListaEncuestas("1=1");
//guardamos el email de la sesion que esta iniciada
        $nombreSesion = $sesion->getUsuario()->getNombre();
        $modeloJoin = new ModeloJoinEPR($bd);
        $modeloPregunta = new ModeloPregunta($bd);
        $modeloRespuesta = new ModeloRespuesta($bd);
        $array = $modeloJoin->getListCompletas(0, 10, 'e.id="' . $idencuesta . '"');
        $array2 = $modeloJoin->getListIncompletas(0, 10, 'e.id="' . $idencuesta . '"');
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
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.pregunta').next().toggle();
                $('.pregunta').next().next().toggle();
                $('.pregunta').next().next().next().toggle();
                $('.pregunta').click(function() {
                    $(this).find('span').text("«");
                    $(this).next().toggle();
                    $(this).next().next().toggle();
                    $(this).next().next().next().toggle("slow");
                });
            });
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
                    <a class="navbar-brand" href="#"><?php echo $nombreSesion; ?> (Administrador)</a>
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
                            <li><a href="../procesa/phpCerrarSesion.php?nombresesion=<?php $nombreSesion ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                <a href="../../encuesta/view/verTodos.php" class="active"><i class="fa fa-group fa-fw"></i> Ver todas</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div id="page-wrapper"style="min-height: 592px">
                <br>
                <!-- ///////////////////////////////////////////////////////////////////  -->
                <ul>
                    <?php
                    $pregunta = "";
                    $idencuesta = "";
                    foreach ($array2 as $key => $value) {
                        if ($value->getEncuesta()->getId() !== $idencuesta) {
                            echo "<div class='containerEncuesta'><h2 class='encuesta'>" . $value->getEncuesta()->getTitulo() . "</h2></div>";
                            $tituloEncuesta = $value->getEncuesta()->getTitulo();
                            $idencuesta = $value->getEncuesta()->getId();
                            echo "<ul>";
                        }
                        if ($value->getPregunta()->getId() !== $pregunta && $value->getPregunta()->getId()) {
                            echo "</ul>";
                            echo "<h3 class='pregunta'><span>»</span>" . $value->getPregunta()->getTexto() . "</h3>";
                            $pregunta = $value->getPregunta()->getId();
                            if ($sesion->isAdministrador() || $sesion->getUsuario()->getEmail() == $value->getEncuesta()->getEmail()) {
                                echo "<a class='borrar' href='../procesa/phpBorrarPregunta.php?idpregunta=" . $pregunta . "'>Borrar</a>";
                            }
                            echo "<a class='anadirRespuesta' href='viewNuevaRespuesta.php?idpregunta=" . $pregunta . "'>Contestar pregunta</a>";
                            echo "<ul>";
                        }
                        if ($value->getRespuesta()->getTexto()) {
                            echo "<li><h4 class='respuesta'>" . $value->getRespuesta()->getTexto() . "</h4>";
                            if ($sesion->isAdministrador() || $sesion->getUsuario()->getEmail() == $value->getEncuesta()->getEmail()) {
                                echo "<a class='borrar' href='../procesa/phpBorrarPregunta.php?idpregunta=" . $pregunta . "'>Borrar</a>";
                            }
                            echo "</li>";
                        } else if ($value->getPregunta()->getId()) {
                            echo "<li><h4 class='respuesta'>Esta pregunta aun no tiene respuestas</h4></li>";
                        }
                    }
                    ?>
                </ul>
                <hr>
                <h2>Añadir Pregunta a esta encuesta:</h2>
                <form action="../procesa/phpNuevaPregunta.php" method="POST">
                    <input type="hidden" name="idencuesta" value="<?php echo $idencuesta; ?>">
                    <label>Encuesta: </label><input name='idencuesta' type='text' value='<?php echo $tituloEncuesta ?>' disabled=''/><br><br>
                    <label>Pregunta: </label><input name='texto' type='text' value='' /><br><br>
                    <input type="submit" value="Añadir pregunta">
                </form>    



                <!-- ///////////////////////////////////////////////////////////////////  -->
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
