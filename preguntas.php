<?php


session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
}
$id = $_SESSION['id_usuario'];

$cantidad = getCualquiera('descripcion', 'tbl_parametros', 'id_parametro', 9);


$cant_usu = getCualquiera('count(*)', 'tbl_respuestas', 'id_usuario', $id);


$falta = $cantidad - $cant_usu;


$errors = array();

if ($falta == 0) {
    $bole = cambiaEstado($id);
    $_SESSION['estado_usuario'] = 'ACTIVO';
    print("<script>window.location.replace('act_pass.php');</script>");
}
if (!empty($_POST)) {
    $pre = $_POST['pregunta'];
    $res = $_POST['respuesta'];

    if ($res != null or $res  != " ") {

        $agrego = grabarRES($id, $pre, $res);


        if ($agrego == 0) {

            // print "<script>alert('Ocurrio un error al agregar la respuesta.')</script>";
            // $errors[]="Ocurrio un error al agregar la respuesta.";
        }



        if ($cantidad > $cant_usu) {
            print "<script>alert('Vamos a la siguiente.')</script>";
            print("<script>window.location.replace('preguntas.php');</script>");
        }
    } else {

        print "<script>alert('Llene todos los campos.')</script>";
    }
}


//echo $_SESSION['menus'];
?>

<!DOCTYPE html>

<head>
    <title>HOME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/morris.css" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="css/monthly.css">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
    <script src="js/raphael-min.js"></script>
    <script src="js/morris.js"></script>
    <link rel="stylesheet" href="css/toastr.min.css">
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="#" class="logo">
                    PREGUNTAS
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="images/2.png">
                            <span class="username"><?php echo $_SESSION['usuario'] ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">

                            <li><a href="logout.php"><i class="fa fa-key"></i> Salir</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <?php

                        //echo $_SESSION['menus'];
                        ?>

                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

            </section>
            <div class="form-w3layouts">
                <!-- page start-->


                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading" style="text-transform: uppercase;text-align: center;">Nos alegra tenerte en Tecniwash!</h4>
                                <br>
                                <p>Para poder brindarte un mejor servicio elije las preguntas de tu preferencia y respondelas como tu quieras, estas preguntas luego nos serviran en caso que necesites recuperar tu password en caso que lo olvies</p>
                                <hr>
                                <p class="mb-0">Intenta que las preguntas que elijas, puedas recordar su respuesta y que no sean muy faciles de adivinar.</p>
                            </div>
                            <header class="panel-heading">
                                Preguntas &nbsp;&nbsp; <?php echo $cant_usu ?> / <?php echo $cantidad ?>
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="fa fa-cog" href="javascript:;"></a>

                                </span>
                            </header>
                            <div class="panel-body">
                                <div class="form">
                                    <form class="cmxform form-horizontal " id="preguntas" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <div class="form-group">
                                            <label for="password" class="control-label col-lg-3">Preguntas</label>

                                            <div class="col-lg-6">
                                                <select id="pregunta" class="form-control" name="pregunta">

                                                    <?php
                                                    $query_cod_veh = mysqli_query($mysqli, "SELECT p.id_pregunta, p.pregunta FROM tbl_preguntas p
WHERE p.id_pregunta NOT IN(SELECT id_pregunta from tbl_respuestas where id_usuario= $id )");
                                                    while ($rw = mysqli_fetch_array($query_cod_veh)) {
                                                    ?>
                                                        <option value="<?php echo $rw['id_pregunta']; ?>"><?php echo $rw['pregunta']; ?></option>
                                                    <?php
                                                    }

                                                    ?>





                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="firstname" class="control-label col-lg-3">Respuesta</label>
                                            <div class="col-lg-6">
                                                <input class=" form-control" id="respuesta" title="Respuesta" onPaste="return false;" name="respuesta" autocomplete="off" type="text" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-6">
                                                <button id="btn-login" class="btn btn-primary" type="submit">Guardar</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- page end-->
            </div>
            <script>






            </script>





        </section>
        <!--main content end-->
    </section>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
    <script src="js/toastr.min.js"></script>
    <!-- morris JavaScript -->

    <!-- calendar -->
    <script type="text/javascript" src="js/monthly.js"></script>

    <!-- //calendar -->
</body>

</html>