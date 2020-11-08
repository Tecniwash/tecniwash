<?php
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = '';
$type = 'success';

function getCorreo($campo, $tabla, $campoWhere, $valor)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT $campo FROM $tabla WHERE $campoWhere = ? ");
	$stmt->bind_param('s', $valor);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0) {
		$stmt->bind_result($_campo);
		$stmt->fetch();
		return $_campo;
	} else {
		return null;
	}
}

if (!empty($_POST)) {
	$userName = $_POST['email'];
	$email = getCorreo('correo_electronico', 'tbl_usuario', 'usuario', $userName);
	if (emailExiste($email)) {
		if (validarEmail($email) == 1) {
			$usuariocam = "usuario";
			$nombre = getValor('nombre_usuario', 'correo_electronico', $email);
			$user_id = getValor('id_usuario', "correo_electronico", $email);
			$token = '';
			for ($i = 0; $i < 16; $i++) {
				$token .= chr(rand(65, 90));
			}
			$token1 = generaTokenPass($user_id, $token);
			$host = $_SERVER["HTTP_HOST"];
			if ($host == 'localhost') {
				$url = $host . "/tw/reset_password.php?userid={$user_id}&token={$token}";
			} else {
				$url = "$host/reset_password.php?userid={$user_id}&token={$token}";
			}
			$asunto = 'Recuperar Password';
			grabarBitacora($user_id, 'Recuperacion de Password', 'Solicitud', 'Se solicito recuperacion de password mediante correo electronico');

			$cuerpo = "<h1 style='text-align:center'>Hola {$nombre}</h1>
			<h3 style='text-align:center'>Se ha solicitado un cambio de password para su cuenta de Tecniwash</h3>
			<div style='margin-top:15px'>
			<p>En caso de que usted no haya solicitado el cambio de password porfavor ignores este mensaje y su password sera la misma</p>
        <p style='text-align:center'>para recuperar su password haga click en el siguiente boton</p>
        <div style='display:flex;justify-content:center'>
        <a href='{$url}'><button style='background-color:#bb1f2a;border:none;padding:10px 40px;color:#fff;border-radius:15px;font-size:20px;text-transform:uppercase;cursor: pointer;'>click aqui</button></a>
        </div>
        <h3 style='text-align:center;margin-top:15px'>Tambien puede copiar y pegar el siguiente enlace</h3>
        <h4 style='text-align:center;background-color:#22368f;color:#fff;font-size:20px'>{$url}</h4>
			</div>";
			$lowerState = getCualquiera('estado_usuario', 'tbl_usuario', 'id_usuario', $user_id);
			$lowerState = strtolower($lowerState);
			$enviado = enviarEmail($email, $nombre, $asunto, $cuerpo);
			if ($enviado == true) {
				$errors = 'Se ha enviado un enlace para cambiar tu password a ' . $email . ' favor verifica tu correo';
				$type = 'success';
			} else {
				$errors = 'Hemos tenido problemas de servidor para enviar tu recuperacion de password ';
				$type = 'danger';
			}
		} else {
			$errors = 'El siguiente correo electronico (' . $email . ') asociado con esta cuenta tiene un formato incorrecto favor ponerse en contacto con su administrador';
			$type = 'danger';
		}

		global $mysqli;
		$hoy = new DateTime();
		$stmt = $mysqli->prepare("UPDATE tbl_usuario SET fecha_cambio_contrasena=NOW() WHERE id_usuario = ?");
		$stmt->bind_param('i', $user_id);
		$stmt->execute();
		$stmt->close();
		//		$errors = "mensaje enviado con exito al correo: {$email}";
		//		$type = 'success';
	} else {
		$errors = "El usuario no existe intentalo de nuevo";
		$type = 'danger';
	}
}


?>
<html>

<head>
	<title>Recuperar Password</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="css/stylelogin.css" type="text/css" />
	<link rel="stylesheet" href="css/font-awesome.css">
	<!-- <script src="js/bootstrap.min.js"></script> -->

</head>

<body>

	<img style="margin-top:1%" src="images\tecniwahs_logo.png" alt="tecniwash logo" srcset="">
	<div class="container">
		<?php
		if ($errors != '') {
			echo showMessage($errors, $type);
		}
		?>
	</div>
	<div class="w3ls-login">
		<form class="" method="post" id="recuperarPass">
			<div class="agile-field-txt">
				<h4 style="font-size: 20px;font-weight:300">Recuperar Contraseña</h4>
			</div>
			<div class="agile-field-txt">
				<label>
					<i class="glyphicon glyphicon-user" aria-hidden="true"></i>Nombre De Usuario :</label>
				<input type="text" class="form-control" style="text-transform: uppercase;" name="email" placeholder="Usuario" autocomplete="Off" required />
				<span id="check-e"></span>
			</div>

			<div class="agile-field-txt">
				<a data-toggle="modal" href="recupera_pre.php" style="cursor: pointer;">Recuperar Mediante Preguntas</a>
			</div>

			<hr />

			<div class="w3ls-login  w3l-sub">
				<input type="submit" name="btn-login" class="btn btn-default">

			</div>
			<div class="form-group">


				<br>
				<a data-toggle="modal" href="index.php" style="cursor: pointer;">Regresar al Login</a>

			</div>
			<br />
		</form>

	</div>
</body>

</html>