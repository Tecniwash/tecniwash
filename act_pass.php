<?php


session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
}
$id = $_SESSION['id_usuario'];
$nom= $_SESSION['usuario'];
$bita=grabarBitacora($id,'Pantalla Actulizar Nuevo pass ','INGRESO','ingreso $nom');
if (!empty($_POST)) {
    $pass = $_POST['pass1'];
    $repass = $_POST['pass2'];



       


    if ($pass == $repass) {
        if (preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,16}$/', $pass)) {
            
            $historial =passHistorial($id,$pass);
            if ($historial == false){
                print "<script>alert('Contraseña ya fue utilizada anteriormente.')</script>";
                print("<script>window.location.replace('act_pass.php');</script>");

            }





            $pass_hash = hashPassword($pass);
            $bol = updPass($pass_hash, $id);
            if ($bol == true) {
                grabarHisPas($us,$pass_hash );
                print "<script>alert('Usuario nuevo configurado con exito.')</script>";
                print("<script>window.location.replace('logout.php');</script>");
            }
        } else {
            print "<script>alert('Su Contraseña debe Incluir Una Mayúscula, Minuscula, Números y Caracteres Especiales.')</script>";
            print("<script>window.location.replace('act_pass.php');</script>");
        }
    } else {

        print "<script>alert('Llene todos los campos y recuerde que deben ser iguales.')</script>";
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


    <link rel="stylesheet  prefetch" href="css/bootstrap.min.css" >
<link rel="stylesheet  prefetch" href="css/bootstrap-theme32.min.css" >
<link rel="stylesheet  prefetch" href="css/bootstrapValidator32.min.css" >
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="#" class="logo">
                    Password
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
                            <header class="panel-heading">
                                Actualiza tu password
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="fa fa-cog" href="javascript:;"></a>

                                </span>
                            </header>
                            <div class="panel-body">
                                <div class="form">
                                    <form class="cmxform form-horizontal " id="preguntas" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                        

    <div class="form-group">
	 <label class="control-label col-lg-3" >Contraseña:</label>
      <div class="col-lg-6">
       <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		  <input maxlength="20" type= "password" name="pass1" placeholder="Password"  id="pass1" title="debe contener una mayuscula , numero , signo especial no menor a 8" class="form-control" autocomplete="off" autofocus="on" onkeyup="return nospaces2()" onPaste="return false;" required>
          <span id="show-hide-passwd" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>
         </div>
        </div>
       </div>
       
     <script>
        	function nospaces2(){
		orig=document.form.pass1.value;
		nuev=orig.split(' ');
		nuev=nuev.join('');
		document.form.pass1.value=nuev;
		if(nuev=orig.split(' ').length>=2);
	}
    </script>


        
        
     <div class="form-group">
	  <label class="control-label col-lg-3" >Confirmar Contraseña:</label>
      <div class="col-md-6 inputGroupContainer">
		 <div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			<input maxlength="20" type= "password" name="pass2" placeholder="Confirmar Password" id="pass2" title="debe ser igual a la Contraseña" class="form-control" autocomplete="off" autofocus="on" onkeyup="return nospaces1()" onPaste="return false;" required>
		 	<span id="show-hide-passwd1" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>
      	  </div>
         </div>
       </div>

       <script>
        	function nospaces1(){
		orig=document.form.pass2.value;
		nuev=orig.split(' ');
		nuev=nuev.join('');
		document.form.pass2.value=nuev;
		if(nuev=orig.split(' ').length>=2);
	}
    </script>

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


$(document).on('ready', function() {
                $('#show-hide-passwd').on('click', function(e) {
                    e.preventDefault();
                    var current = $(this).attr('action');
                    if (current == 'hide') {
                        $(this).prev().attr('type','text');
                        $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action','show');
                    }
                    if (current == 'show') {
                        $(this).prev().attr('type','password');
                        $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action','hide');
                        
                       
                    }
                })
            })
                
                
                            $(document).on('ready', function() {
                $('#show-hide-passwd1').on('click', function(e) {
                    e.preventDefault();
                    var current = $(this).attr('action');
                   
                    if (current == 'hide') {
                        $(this).prev().attr('type','text');
                        $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action','show');
                    }
                    if (current == 'show') {
                        $(this).prev().attr('type','password');
                        $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action','hide');
                        
                       
                    }
                })
            })
                function myFunction() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }




                function myFunction2() {
                    var x = document.getElementById("pass");
                    var y = document.getElementById("repass");
                    if (x.type === "password") {
                        x.type = "text";
                        y.type = "text";
                    } else {
                        x.type = "password";
                        y.type = "password";
                    }
                }
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
    <!-- morris JavaScript -->

    <!-- calendar -->
    <script type="text/javascript" src="js/monthly.js"></script>

    <!-- //calendar -->
</body>

</html>