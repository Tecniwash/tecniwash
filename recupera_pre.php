<?php

require 'funcs/conexion.php';
require 'funcs/funcs.php';
$errors = '';
$type;
$access = false;

if (!empty($_POST['email'])) {
	$user = $mysqli->real_escape_string($_POST['email']);

	if (usuarioExiste($user)) {

		$user_id = getValor('id_usuario', 'usuario', $user);
		header('Location:recupera_pre.php?user_id=' . $user_id);
	} else {
		$errors = "El usuario ingresado no existe, intente nuevamente";
		$type = 'danger';
	}
}

if (!empty($_POST['password'])) {
	$pass = $_POST['password'];
	$confPass = $_POST['con_password'];
	$userid = $_GET['user_id'];
	if ($pass != $confPass) {
		$errors = 'Lamentablemente las contraseñas ingresadas no coinciden, Intentalo de Nuevo';
		$type = 'danger';
		$access = true;
	} else {
		$usuario = $_POST['password'];
		$confPass = hashPassword($pass);
		$id = $_GET['user_id'];
		$userName = getCualquiera('usuario', 'tbl_usuario', 'id_usuario', $id);
		if (passHistorial($id, $pass)) {
			if (minMaxPass($pass)) {
				if (validar_clave($pass, $errors)) {
					grabarHisPas($userName, $confPass);
					updPass($confPass, $userid);
					$user_id = $_GET["user_id"];
					grabarBitacora($user_id, 'Recuperacion de Contrasenia', 'Cambio', 'Se realizo un cambio de contrasenia mediante preguntas');
					$errors = 'Muy Bien Contraseña actualizada correctamente, por favor espere unos segundos';
					$type = 'success';
					print("<script>setTimeout(function(){location.href='index.php';},3000);</script>");
				} else {
					$type = 'danger';
					$access = true;
				}
			} else {
				$errors = 'Recuerda que tu contraseña debe de ser minimo de 8 caracteres y maximo 10 intenta de nuevo';
				$type = 'danger';
				$access = true;
			}
		} else {
			$errors = 'Lamentablemente la contraseña que has ingresado ya ha sido utilizada intenta con otra';
			$type = 'danger';
			$access = true;
		}
	}
}


function getPregunta($idUser, $idPregunta)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT respuesta FROM tbl_respuestas where id_usuario = ? and id_pregunta=?;");
	$stmt->bind_param('ii', $idUser, $idPregunta);
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

if (!empty($_POST['respuesta'])) {
	$respuesta = $_POST['respuesta'];
	$pregunta = $_POST['pregunta'];
	$user_id = $_GET['user_id'];
	$respuestaBd = getPregunta($user_id, $pregunta);
	if ($respuesta == $respuestaBd) {
		$errors = "Respuesta Correcta Ingrese Nueva Contraseña";
		$type = 'success';
		$access = true;
	} else {
		$errors = "Respuesta Incorrecta Intentalo Nuevamente";
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

</head>

<body>
	<style>
		.fa-eye:before {
			content: "\f06e";
		}
	</style>

	<div class="container">
		<img style="margin-top:1%" src="images\tecniwahs_logo.png" alt="tecniwash logo" srcset="">
		<?php
		$min = getCualquiera('descripcion', 'tbl_parametros', 'id_parametro', 5);
		$max = getCualquiera('descripcion', 'tbl_parametros', 'id_parametro', 6);
		echo "<input style='display:none' type='text' id='minlength' value='$min'>";
		echo "<input style='display:none'type='text' id='maxlength' value='$max'>";
		if (empty($_GET['user_id'])) {
			if ($errors != '') {
				echo showMessage($errors, $type);
			}

		?>
			<div class="w3ls-login">

				<form class="" method="post" id="loginform">
					<div class="agile-field-txt">
						<h3 style="font-size: 20px;font-weight:500">Recuperar Password</h3>
					</div>
					<div class="agile-field-txt">
						<label>
							<i class="glyphicon glyphicon-user" aria-hidden="true"></i>Nombre De Usuario :</label>
						<input type="text" maxlength="15" style="text-transform: uppercase;" class="form-control" autocomplete="off" name="email" placeholder="Usuario" required />
						<span id="check-e"></span>
					</div>

					<div class="w3ls-login  w3l-sub">
						<input type="submit" name="btn-login" value="Enviar" class="btn btn-default">
					</div>
					<div class="form-group">


						<br>
						<a href="index.php" style="cursor: pointer;">Regresar al Login</a>

					</div>
				</form>

			</div>
		<?php
		} else if ($access == false) {
		?>
			<div class="container">
				<?php
				if ($errors != '') {
					echo showMessage($errors, $type);
				}
				?>
			</div>
			<div class="w3ls-login">
				<form class="" method="post" id="loginform">
					<div class="agile-field-txt">
						<h3 style="font-size: 20px;font-weight:500">Seleccione Pregunta De Seguridad</h3>
					</div>
					<div class="agile-field-txt">
						<?php
						$user_id = $_GET['user_id'];
						global $mysqli;
						$conexion = $mysqli;
						$consulta = "SELECT p.id_pregunta, p.pregunta FROM tbl_preguntas p WHERE p.id_pregunta";
						$result = mysqli_query($conexion, $consulta); {
						?>
							<select name="pregunta" class="form-control" id="sectorbox">
								<?php
								while ($row = mysqli_fetch_array($result)) {
									echo '<option value="' . $row['id_pregunta'] . '">' . ' - ' . $row['pregunta'] . '</option>';
								}

								?>
							</select>
						<?php
						}
						?>
					</div>
					<div class="agile-field-txt">
						<input type="text" class="form-control" maxlength="15" name="respuesta" placeholder="Respuesta" autocomplete="off" required />
						<span id="check-e"></span>
					</div>

					<div class="w3ls-login  w3l-sub">
						<input type="submit" name="btn-login" value="Enviar" class="btn btn-default">
					</div>
					<div class="form-group">


						<br>
						<a href="index.php" style="cursor: pointer;">Regresar al Login</a>

					</div>
				</form>

			</div>
		<?php
		} else if ($access == true) {
		?>
			<div class="container">
				<?php
				if ($errors != '') {
					echo showMessage($errors, $type);
				}
				?>
			</div>
			<div class="w3ls-login">


				<form class="" method="post" id="loginform">
					<div class="agile-field-txt">
						<h3 style="font-size: 20px;font-weight:500">Cambiar Password</h3>
					</div>
					<div class="agile-field-txt">
						<label>
							<i class="glyphicon glyphicon-lock" aria-hidden="true"></i>Neva Contraseña: <span id="passCount"></span></label>
						<input type="password" maxlength="10" autocomplete="off" class="form-control" name="password" placeholder="Contraseña" id="password" onkeyup="charCounter(this.value,'passCount')" required />
						<span toggle="password-field" id="eye" class="fa fa-eye field-icon" toggleClass=" toggle-password" onclick="verPassword('password')"></span>
					</div>

					<div class="agile-field-txt">
						<label>
							<i class="glyphicon glyphicon-lock" aria-hidden="true"></i>Confirmar Nueva Contraseña: <span id="charcount"></span></label>
						<input type="password" maxlength="10" class="form-control" name="con_password" placeholder="Password" id="conf_password" onkeyup="charCounter(this.value,'charcount')" required />
						<span toggle="password-field" id="eye" class="fa fa-eye field-icon" toggleClass=" toggle-password" onclick="verPassword('conf_password')"></span>
						<small style="text-align: left;" id="passwordHelpBlock" class="form-text text-muted">
							Recuerda que tu contraseña debe tener como minimo 8 caracteres y un maximo de 10
						</small>
					</div>

					<div class="w3ls-login  w3l-sub">
						<input type="submit" name="btn-login" value="Modificar" class="btn btn-default">
					</div>
				</form>

			</div>
		<?php
		}
		?>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script>
		function verPassword(id) {
			var x = document.getElementById(id);
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}

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
	</script>

</body>

</html>