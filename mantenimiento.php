<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
}

if ($_SESSION['estado_usuario'] == strtolower('nuevo')) {
    header("Location: preguntas.php");
}
$id_usu = $_SESSION['id_usuario'];
//echo $_SESSION['menus'];

$objeto = "pantalla usuario";
$accion = "INGRESO";
$descripcion = "ingreso a pantalla usuario";

$bita = grabarBitacora($id_usu, $objeto, $accion, $descripcion);


?>

<!DOCTYPE html>
<html>

<head>
    <title>Servicios Disponibles</title>
    <link rel="icon" href="images\favicon\favicon.ico" type="image/ico" sizes="16x16">
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
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="home.php" class="logo">
                    MENU
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

                            <li><a href="logout.php"><i class="fa fa-key"></i>Salir</a></li>
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
                        if ($id_usu == 1) {
                            include("menu2.php");
                        }
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
                <div class="table-agile-info">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mantenimiento De Servicios
                            <div class="btn-group pull-right">
                                <button type='button' class="btn btn-success" onClick="location.href='add_product.php'"><span class="glyphicon glyphicon-plus"></span> Agregar </button>
                            </div>
                        </div>
                        <div class="row w3-res-tb">

                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-addon">INICIO</span>
                            <input  type="date" id="fecha_ini"  name="fecha_ini" placeholder="FECHA INICIO"></div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">FIN</span>
                            <input  type="date"   id="fecha_fin" name="fecha_fin"  >
                            <button id="procesar" style="margin:0 15px" class="btn btn-primary">Procesar</button>
                            <button class="btn btn-default" title="salir de la consulta"><span class="fa fa-outdent" title="salir de la consulta"  onclick="load(1)"></span></button>
                        </div>
                        <div id="resultados"></div><!-- Carga los datos ajax -->
                        <div class='outer_div'></div>

                    </div>

                            </div>
                        </div>
                        <div id="resultados">
                        <div class="table-responsive" id="tableListar_length">
    <table class="table table-striped b-t b-light" id="tableListar" style="margin: 10px 0 0 0;">
        <thead>
            <tr class="success">
                <th>Nombre Del Servicio</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM tbl_servicios order by id_servicios ASC";
            $query = mysqli_query($mysqli, $sql);
            $count_query   = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM tbl_usuario");
            $row1 = mysqli_fetch_array($count_query);
            $numrows = $row1['numrows'];
            if ($numrows > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $product_id = $row['id_servicios'];
                    $nombre = $row['nombre'];
                    $descripcion = $row['descripcion'];
            ?>
                    <tr>
                        <td><?php echo $nombre ?></td>
                        <td><?php echo $descripcion; ?></td>
                        <td>
                            <a href="add_product.php?idProduct=<?php echo $product_id ?> " class='btn btn-default' ui-toggle-class=""><i class="fa fa-pencil text-success text-dark"></i></a>
                            <a href="#" class='btn btn-default' title='Eliminar Producto' data-toggle="modal" data-target="#myModal4" onclick='obtener_id("<?php echo $product_id; ?>")'><i class="glyphicon glyphicon-remove"></i></a>
                            <script>
                                function reportePDF2() {
                                    var desde = $id;
                                    let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`;
                                    open('reporte/re_prueba.php?id=' + id, 'test', params);
                                }
                            </script>

                        </td>
                    </tr>
                <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
                        </div><!-- Carga los datos ajax -->
                        <div class='outer_div'></div>

                    </div>
                </div>
            </section>
            <script src="js/bootstrap-datepicker.js"></script>
            <script src="js/locales/bootstrap-datepicker.es.js"></script>
            <script src="js/jquery.dataTables.min.js"></script>
            <script src="js/dataTables.bootstrap.js"></script>
            <script src="js/global.js"></script>
            <script src="js/bootstrap.js"></script>
            <script src="js/jquery.dcjqaccordion.2.7.js"></script>
            <script src="js/scripts.js"></script>
            <script src="js/jquery.slimscroll.js"></script>
            <script src="js/jquery.nicescroll.js"></script>
            <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
            <script src="js/jquery.scrollTo.js"></script>
            <!-- morris JavaScript -->
            <!-- calendar -->
            <script type="text/javascript" src="js/monthly.js"></script>

            <!-- //calendar -->
</body>
<?php

require 'modal/eliminar_producto.php';

?>

</html>
<script>
    $(document).ready(function() {
        load(1);
    });

    function obtener_id(id, titulo, descripcion) {
        $("#product_id").val(id);
    }


    $("#editar_password").submit(function(event) {
        $('#actualizar_datos3').attr("disabled", true);

        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "ajax/eliminar_producto.php",
            data: parametros,
            beforeSend: function(objeto) {
                $("#mensajeAjax").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#mensajeAjax").html(datos);
                $('#actualizar_datos3').attr("disabled", false);
                load(1);
                setTimeout(function() {
                    limpiarMensaje('mensajeAjax');
                    $('#myModal4').modal('hide');
                }, 3000);
            }
        });
        event.preventDefault();
    })

    function limpiarMensaje(id) {
        let content = document.getElementById(id);
        content.removeChild(content.lastElementChild);
    }

</script>