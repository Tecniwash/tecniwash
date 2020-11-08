<?php

require 'funcs/conexion.php';
require 'funcs/funcs.php';
$errors = '';
$type = 'success';
if ($_GET) {
    $userid = $mysqli->real_escape_string($_GET['userid']);
    $token = $mysqli->real_escape_string($_GET['token']);
    $tokenBd = getCualquiera('token_password', 'tbl_usuario', 'id_usuario', $userid);
}

$objeto = "cambia_pass";
$accion = "INGRESO";
$descripcion = "Esta en la pantalla de cambia password";
$bita = grabarBitacora($userid, $objeto, $accion, $descripcion);

if (!verificaTokenPass($userid, $token)) {
    echo 'aqui se quedo';
    $errors =  'No se pudo verificar el token disculpa las molestias';
    $type = 'danger';
    print("<script>setTimeout(function(){location.href='index.php';},3000);</script>");
}
if ($token == $tokenBd) {

    $fechaBd = new DateTime(getCualquiera('fecha_cambio_contrasena', 'tbl_usuario', 'id_usuario', $userid)); //fecha inicial obtenida de la BD
    $hoy = new DateTime(); //fecha de cierre
    $intervalo = $hoy->diff($fechaBd);
    $horas = $intervalo->format('%H');
    $dias = $intervalo->format('%d');
    if ($dias > 0) {
        $errors =  'El token ha caducado, disculpa las molestias, solicita nuevo cambio de contraseña';
        $type = 'danger';
    }
}

if ($_POST != null) {
    $pass = $_POST['password'];
    $confPass = $_POST['con_password'];

    if ($pass != $confPass) {
        $errors = 'Lamentablemente las contraseñas ingresadas no coinciden, Intentalo de Nuevo';
        $type = 'danger';
    } else {
        $errors = 'Muy Bien Contraseña actualizada correctamente, por favor espere unos segundos';
        $type = 'success';
        $confPass = hashPassword($pass);
        $user_id = $_GET['userid'];
        $userName = getCualquiera('usuario', 'tbl_usuario', 'id_usuario', $user_id);
        if (passHistorial($user_id, $pass)) {
            if (minMaxPass($pass)) {
                if (validar_clave($pass, $errors)) {
                    grabarHisPas($userName, $confPass);
                    grabarBitacora($user_id, 'Cambio de Contrasenia', 'Cambio', 'Se realizo con exito un cambio de contrasenia mediante correo electronico');
                    updPass($confPass, $user_id);
                    $errors = 'Muy Bien Contraseña actualizada correctamente, por favor espere unos segundos';
                    $type = 'success';
                    print("<script>setTimeout(function(){location.href='index.php';},3000);</script>");
                } else {
                    $type = 'danger';
                }
            } else {
                $errors = 'Recuerda que tu contraseña debe de ser minimo de 8 caracteres y maximo 10 intenta de nuevo';
                $type = 'danger';
            }
        } else {
            $errors = 'Lamentablemente la contraseña que has ingresado ya ha sido utilizada intenta con otra';
            $type = 'danger';
        }
    }
}

?>


<html>

<head>
    <title>Cambiar Password</title>

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/stylelogin.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.css">

    <script src="js/bootstrap.min.js"></script>
    <script src="../login/js/jquery.min.js"></script>
    <script src="../login/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="../login/css/bootstrap.min.css">
    <link rel="stylesheet" href="../login/css/bootstrap-theme.min.css">

    <script src="../login/js/jquery.min.js"></script>
    <script src="../login/js/bootstrap.min.js"></script> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylelogin.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.css">

</head>

<body>

    <div class="container">
        <img style="margin-top:1%" src="images\tecniwahs_logo.png" alt="tecniwash logo" srcset="">
        <?php
        $min = getCualquiera('descripcion', 'tbl_parametros', 'id_parametro', 5);
        $max = getCualquiera('descripcion', 'tbl_parametros', 'id_parametro', 6);
        echo "<input style='display:none' type='text' id='minlength' value='$min'>";
        echo "<input style='display:none'type='text' id='maxlength' value='$max'>";
        if ($errors != '') {
            echo showMessage($errors, $type);
        }
        ?>
        <div class="w3ls-login">


            <form class="" method="post" id="loginform">
                <div class="agile-field-txt">
                    <h3 style="font-size: 20px;font-weight:500">Cambiar Password</h3>
                </div>
                <div class="agile-field-txt">
                    <label>
                        <i class="glyphicon glyphicon-lock" aria-hidden="true"></i>Nueva Contraseña: <span id="passCount"></span></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" onkeyup="charCounter(this.value,'passCount')" required />
                    <span toggle="password-field" id="eye" class="fa fa-eye field-icon" toggleClass=" toggle-password" onclick="verPassword('password')"></span>
                </div>

                <div class="agile-field-txt">
                    <label>
                        <i class="glyphicon glyphicon-lock" aria-hidden="true"></i>Confirmar Contraseña: <span id="charcount"></span></label>
                    <input type="password" class="form-control" name="con_password" placeholder="Password" id="conf_password" onkeyup="charCounter(this.value,'charcount')" required />
                    <span toggle="password-field" id="eye" class="fa fa-eye field-icon" toggleClass=" toggle-password" onclick="verPassword('conf_password')"></span>
                </div>

                <div class="w3ls-login  w3l-sub">
                    <input type="submit" name="btn-login" value="Modificar" class="btn btn-default">
                </div>

                <!--- <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>-->
            </form>

        </div>
    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
    /* function verPassword(id) {
			var x = document.getElementById(id);
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		} */

    function charCounter(str, id) {
        var lng = str.length;
        var span = document.getElementById(id);
        var min = document.getElementById('minlength').value;
        var max = document.getElementById('maxlength').value;
        if (str.length < min) {
            span.innerHTML = lng + ' de ' + max + ' Caracteres';
            span.style.color = '#bd2130';
        } else {
            span.innerHTML = lng + ' de ' + max + ' Caracteres';
            span.style.color = '#28a745';
        }
    }

    function verPassword(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
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