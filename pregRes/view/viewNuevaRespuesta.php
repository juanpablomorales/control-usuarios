<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
        require '../../require/comun.php';
        $getId = Peticion::get("idpregunta");
        
        $sesion = new Sesion();
        $nombreSesion = $sesion->getUsuario()->getNombre();
        
        $bd = new BaseDatos();
        $modeloPregunta = new ModeloPregunta($bd);
        $pregunta = $modeloPregunta->getPregunta($getId);
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
                $('.pregunta').click(function() {
                    $(this).find('span').text("«");
                    $(this).next().toggle();
                    $(this).next().next().toggle("slow");
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
                <h1>Formulario de respuesta a la pregunta...</h1>
                <h2 style="font-style: italic">"<?php echo $pregunta->getTexto() ?>"</h2>

                <h3>Introduce una nueva respuesta:</h3>
                <form action="../procesa/phpNuevaRespuesta.php" method="post">
                    <input name="idpregunta" type="hidden" value="<?php echo $pregunta->getId() ?>">
                    <input name="idencuesta" type="hidden" value="<?php echo $pregunta->getIdencuesta() ?>">
                    <textarea name="texto" rows="4" cols="80"></textarea>
                    <br>
                    <input type="submit" value="Añadir Respuesta">
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



