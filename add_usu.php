<?php


session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
}
$id_usu = $_SESSION['id_usuario'];

$us = 0;
//para que cuando sea agregar el rol sea nuevo predeterminado
$rol = 5;
$token = generateRandomString();
//for ($i = 0; $i < 16; $i++) {
//	$token .= chr(rand(65, 90));
//}


//echo $token;

if (isset($_GET["us"])) {
    $us = $_GET["us"];

    $arreglo = getArray("tbl_usuario", "id_usuario", $us);
    $nom = $arreglo['nombre_usuario'];
    $usu = $arreglo['usuario'];
    $rol = $arreglo['id_rol'];
    $estado = $arreglo['estado_usuario'];
    $corr = $arreglo['correo_electronico'];
}


//echo $_SESSION['id_usuario'];
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
    <link rel="stylesheet" href="css/toastr.min.css">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
    <script src="js/raphael-min.js"></script>
    <script src="js/morris.js"></script>

    <!-- <link rel="stylesheet  prefetch" href="css/bootstrap2.min" > -->
    <!--<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>-->

    <link rel="stylesheet  prefetch" href="css/bootstrap.min.css">
    <link rel="stylesheet  prefetch" href="css/bootstrap-theme32.min.css">
    <link rel="stylesheet  prefetch" href="css/bootstrapValidator32.min.css">
    <!--   <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
	<link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'> -->



</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="" class="logo">
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

            </section>
            <div class="form-w3layouts">
                <!-- page start-->


                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <?php
                                if ($us != 0) {
                                    echo "Editar  Usuario $usu ";
                                } else {
                                    echo "Agregar Usuario ";
                                } ?>
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>

                                    <a class="fa fa-share" href="usuarios.php"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <div class="form">
                                    <form class="cmxform form-horizontal " method="post" id="loginform" action="" novalidate="novalidate">



                                        <input type="hidden" id="usu" name="usu" <?php echo "value='$us'";  ?>>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3">Nombre Completo:</label>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    <input maxlength="70" type="text" <?php if ($us != 0) {
                                                                                            echo "value=$nom";
                                                                                        } ?> name="txt_nc" placeholder="Nombre" style="text-transform: uppercase;" id="txt_nc" autocomplete="off" autofocus="on" onkeyup="return unspaces()" onkeypress="return soloLetras(event)" class="form-control" onkeypress="return soloLetras(event)" onPaste="return false;" title="nombre Usuario" required>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            function soloLetras(e) {
                                                key = e.keyCode || e.which;
                                                tecla = String.fromCharCode(key).toLowerCase();
                                                letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                                                especiales = "8-37-39-46";

                                                tecla_especial = false
                                                for (var i in especiales) {
                                                    if (key == especiales[i]) {
                                                        tecla_especial = true;
                                                        break;
                                                    }
                                                }

                                                if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                                                    return false;
                                                }
                                            }
                                        </script>
                                        <!-- Text input-->

                                        <div class="form-group">
                                            <label class="control-label col-lg-3">Usuario:</label>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    <input maxlength="15" type="text" name="txt_us" <?php if ($us != 0) {
                                                                                                        echo "value=$usu ";
                                                                                                    } ?> placeholder="Usuario" style="text-transform: uppercase;" id="txt_us" autocomplete="off" autofocus="on" onkeyup="return nospaces()" onkeypress="return soloLetras(event)" onkeypress="return soloLetras(event)" onPaste="return false;" class="form-control" title="Usuario solo letras" required>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            function soloLetras(e) {
                                                key = e.keyCode || e.which;
                                                tecla = String.fromCharCode(key).toLowerCase();
                                                letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                                                especiales = "8-37-39-46";

                                                tecla_especial = false
                                                for (var i in especiales) {
                                                    if (key == especiales[i]) {
                                                        tecla_especial = true;
                                                        break;
                                                    }
                                                }

                                                if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                                                    return false;
                                                }
                                            }
                                        </script>

                                        <script>
                                            function soloLetras(e) {
                                                key = e.keyCode || e.which;
                                                tecla = String.fromCharCode(key).toLowerCase();
                                                letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                                                especiales = "8-37-39-46";

                                                tecla_especial = false
                                                for (var i in especiales) {
                                                    if (key == especiales[i]) {
                                                        tecla_especial = true;
                                                        break;
                                                    }
                                                }

                                                if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                                                    return false;
                                                }
                                            }
                                        </script>
                                        <!-- Text input-->


                                        <?php if ($us == 0) { ?>


                                            <div class="form-group">
                                                <label class="control-label col-lg-3" for="inputSuccess">Autogenerar</label>
                                                <div class="col-lg-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" id="auto" name="auto" value="1" onchange="javascript:showVitales()">
                                                            contraseña
                                                        </label>
                                                    </div>


                                                </div>
                                            </div>








                                            <div class="form-group">
                                                <label class="control-label col-lg-3">Contraseña:</label>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                        <input maxlength="20" type="password" name="pass1" placeholder="Password" id="pass1" title="debe contener una mayuscula , numero , signo especial no menor a 8" class="form-control" autocomplete="off" autofocus="on" onkeyup="return nospaces2()" onPaste="return false;" required>
                                                        <span id="show-hide-passwd" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function nospaces2() {
                                                    orig = document.form.pass1.value;
                                                    nuev = orig.split(' ');
                                                    nuev = nuev.join('');
                                                    document.form.pass1.value = nuev;
                                                    if (nuev = orig.split(' ').length >= 2);
                                                }
                                            </script>




                                            <div class="form-group">
                                                <label class="control-label col-lg-3">Confirmar Contraseña:</label>
                                                <div class="col-md-6 inputGroupContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                        <input maxlength="20" type="password" name="pass2" placeholder="Confirmar Password" id="pass2" title="debe ser igual a la Contraseña" class="form-control" autocomplete="off" autofocus="on" onkeyup="return nospaces1()" onPaste="return false;" required>
                                                        <span id="show-hide-passwd1" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function nospaces1() {
                                                    orig = document.form.pass2.value;
                                                    nuev = orig.split(' ');
                                                    nuev = nuev.join('');
                                                    document.form.pass2.value = nuev;
                                                    if (nuev = orig.split(' ').length >= 2);
                                                }
                                            </script>

                                        <?php } ?>










                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="control-label col-lg-3">Rol:</label>
                                            <div class="col-md-6 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                    <select title="Rol del Usuario" class='form-control' name='rol' id='rol' <?php if ($us == 0) {
                                                                                                                                    echo " ";
                                                                                                                                } ?> style="text-transform: uppercase;">
                                                        <?php
                                                        $w = " ";
                                                        if ($rol == 5) {

                                                            $w = "where id_rol=5";
                                                        } else {
                                                            //  $w = " ";
                                                        ?>
                                                            <option value="">Seleccione un Rol</option>
                                                        <?php

                                                        }


                                                        $query_cod_veh = mysqli_query($mysqli, "select * from tbl_roles $w order by id_rol");
                                                        while ($rw = mysqli_fetch_array($query_cod_veh)) {
                                                        ?>
                                                            <option value="<?php echo $rw['id_rol']; ?>" <?php if ($rw['id_rol'] == $rol) {
                                                                                                            echo "selected='selected'";
                                                                                                        } ?>><?php echo $rw['rol']; ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Text input-->
                                        <!-- Text input-->

                                        <div class="form-group">
                                            <label class="control-label col-lg-3">E-Mail</label>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                    <input maxlength="80" type="email" <?php if ($us != 0) {
                                                                                            echo "value=$corr";
                                                                                        } ?> name="correo" placeholder="e-mail" id="correo" autocomplete="off" autofocus="on" o class="form-control" onPaste="return false;" required onkeyup=" nospaces3();">
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            function nospaces3() {
                                                orig = document.form.correo.value;
                                                nuev = orig.split(' ');
                                                nuev = nuev.join('');
                                                document.form.correo.value = nuev;
                                                if (nuev = orig.split(' ').length >= 2);
                                            }

                                            function validar() {
                                                var correo, expresion;
                                                correo = document.getElementById("correo").value;
                                                expresion = /\w+@\w+\.+[a-z]/;

                                                if (correo.length > 80) {
                                                    alert("El campo correo excede su capacidad de caracteres");
                                                } else if (!expresion.test(correo)) {
                                                    alert('El correo no es valido');
                                                    return false;
                                                }
                                            }

                                            /*         
function validar() {
if (/^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3,4})+$/.test('correo')){
alert("La dirección de email " + 'correo' + " es correcta.");
}else {
alert("La dirección de email es incorrecta.");
}
}*/
                                        </script>



                                        <div class="form-group">
                                            <label class="control-label col-lg-3">Estado:</label>
                                            <div class="col-md-6 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>

                                                    <?php if ($us == null) { ?>

                                                        <input type="combo_estado" id="combo_estado" name="combo_estado" class="form-control" value="NUEVO" readonly>


                                                    <?php } else { ?>

                                                        <select name="estado_usuarios" id="estado_usuarios" class="form-control" style="text-transform: uppercase;">
                                                            <option value="-1">--seleccione estado--</option>
                                                            <option value="BlOQUEADO" <?php if ($estado == "BlOQUEADO") {
                                                                                            echo "selected='selected'";
                                                                                        } ?>>BlOQUEADO</option>
                                                            <option value="ACTIVO" <?php if ($estado == "ACTIVO") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>ACTIVO</option>
                                                            <option value="INACTIVO" <?php if ($estado == "INACTIVO") {
                                                                                            echo "selected='selected'";
                                                                                        } ?>>INACTIVO</option>
                                                            <option value="NUEVO" <?php if ($estado == "NUEVO") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>NUEVO</option>

                                                        </select>


                                                    <?php  } ?>




                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-6">
                                                <button class="btn btn-success" onclick="this.form.action='registrar2.php'" value="Guardar" type="submit">Guardar</button>

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












        </section>
        <!--main content end-->
    </section>




    <script>
        $(document).on('submit', '#loginform', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'registrar2.php',
                type: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                success: function(data) {

                    toastr.options.timeOut = 2000;
                    // toastr.options.showMethod = 'fadeIn';
                    // toastr.options.hideMethod = 'fadeOut';
                    // toastr.options.positionClass = 'toast-top-center';

                    if (data == "ok") {
                        toastr.success("Guardado con exito.");
                        setTimeout(function() {
                            location.href = "usuarios.php";
                        }, 1500);
                    } else {
                        toastr.error(data);
                    }
                }
            })
        });





        function showVitales() {
            // element = document.getElementById("auto");
            check = document.getElementById("auto");
            if (check.checked) {
                document.getElementById('pass1').value = '<?php echo $token ?>';
                document.getElementById('pass2').value = '<?php echo $token ?>';
            } else {
                document.getElementById('pass1').value = '';
                document.getElementById('pass2').value = '';
            }
        }





        function showContent() {
            element = document.getElementById("conte");
            check = document.getElementById("check");
            if (check.checked) {
                element.style.display = 'block';
                document.getElementById('incapacidad').value = 1;
                // a=document.getElementById('check').value=1;


                //alert(a)


            } else {
                element.style.display = 'none';
                document.getElementById('incapacidad').value = "0";
                // a=document.getElementById('check').value=2;

                //alert(a)
            }
        }



        $(document).on('ready', function() {
            $('#show-hide-passwd').on('click', function(e) {
                e.preventDefault();
                var current = $(this).attr('action');
                if (current == 'hide') {
                    $(this).prev().attr('type', 'text');
                    $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action', 'show');
                }
                if (current == 'show') {
                    $(this).prev().attr('type', 'password');
                    $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action', 'hide');


                }
            })
        })


        $(document).on('ready', function() {
            $('#show-hide-passwd1').on('click', function(e) {
                e.preventDefault();
                var current = $(this).attr('action');

                if (current == 'hide') {
                    $(this).prev().attr('type', 'text');
                    $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action', 'show');
                }
                if (current == 'show') {
                    $(this).prev().attr('type', 'password');
                    $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action', 'hide');


                }
            })
        })
    </script>



    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
    <!-- morris JavaScript -->
    <script src="js/toastr.min.js"></script>
    <!-- calendar -->
    <script type="text/javascript" src="js/monthly.js"></script>

    <!-- //calendar -->
</body>

</html>