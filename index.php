<?php
//initial commit ansluisa
//commit 2 de Juank
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array();
if (isset($_SESSION['id_usuario'])) {
	header("location: home.php");
	exit;
} else {
?>
	<!DOCTYPE HTML>
	<html>

	<head>



		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>TECNIWASH</title>

		<link rel="stylesheet" href="css/lo.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/toastr.min.css">
		<link rel="stylesheet" href="css/font-awesome.css">




		<!--<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
		<!--<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">-->
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<!--<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">-->
		<link rel="stylesheet" href="css/stylelogin.css" type="text/css" />
		<!--<link rel="stylesheet" href="css/toastr.min.css" >-->
		<!---<link rel="stylesheet" href="css/font-awesome.css" >--->
	</head>
	<style>
		.card {
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
			transition: 0.3s;
			width: 40%;
			padding: 15px;
			margin: 5px;
		}

		.card_footer {
			margin-top: 10px;
		}

		.card:hover {
			box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
		}

		.container {
			padding: 2px 16px;
		}

		/* body {
			background-image: url('images\bg.jpg');
			background-repeat: no-repeat, repeat;
		} */
	</style>

	<body>
		<img style="margin-top:1%" src="images\tecniwahs_logo.png" alt="tecniwash logo" srcset="">
		<!--TECNIWASH<div class="signin-form">-->

		<div class="w3ls-login">


			<form class="" method="post" id="loginform">

				<div class="agile-field-txt">
					<label>
						<i class="glyphicon glyphicon-user" aria-hidden="true"></i> Usuario :</label>
					<input type="text" class="form-control" name="usuario" style=" text-transform: uppercase" onPaste="return false" placeholder="usuario" autocomplete="off" maxlength="15" required />
					<span id="check-e"></span>
				</div>

				<div class="agile-field-txt">
					<label>
						<i class="glyphicon glyphicon-lock" aria-hidden="true"></i> password :</label>
					<input type="password" class="form-control" name="password" placeholder="Password" id="password" maxlength="15" autocomplete="off" required />
					<span toggle="password-field" id="eye" class="fa fa-eye field-icon" toggleClass=" toggle-password" onclick="myFunction()"></span>
				</div>

				<div class="w3ls-login  w3l-sub">
					<input type="submit" name="btn-login" value="Iniciar sesión" class="btn btn-default">

				</div>

				<div class="form-group">


					<br>
					<a data-toggle="modal" data-target="#recuperapass" style="cursor: pointer;">¿Olvidaste tu contraseña?</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="registro.php" style="cursor: pointer;"> ¡Regístrate Aquí !</a>


				</div>
			</form>

		</div>

		<!-- Modal -->
		<div class="modal fade" id="recuperapass" tabindex="-1" aria-labelledby="recuperapassLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="recuperapassLabel">Recuperación de Contraseña</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row" style="display: flex;justify-content: center;">
							<div class="col-sm">
								<div class="card" style="width: 18rem;">
									<img src="images\Emails-amico.png" width="50%" class="card-img-top" alt="...">
									<div class="card-body">
										<h5 class="card-title">Recuperar Mediante Correo</h5>
										<div class="card_footer">
											<a href="recupera.php" class="btn btn-success">Enviar correo</a>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm">
								<div class="card" style="width: 18rem;">
									<img src="images\Taking notes-pana.png" width="50%" class="card-img-top" alt="...">
									<div class="card-body">
										<h5 class="card-title">Recuperar Mediante Preguntas</h5>
										<div class="card_footer">
											<a href="recupera_pre.php" class="btn btn-success">Responder Preguntas</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>





		<!-- Fin del modal -->



		<script>
			function eye() {
				var e = document.getElementById("password");
				e.toggleClass("fa-eye fa-eye-slash");
				var input = $($(this).attr("toggle"));
				if (input.attr("type") == "password") {
					input.attr("type", "text");
				} else {
					input.attr("type", "password");
				}
			};

			function myFunction() {
				var e = document.getElementById("eye");

				var x = document.getElementById("password");
				if (x.type === "password") {
					x.type = "text";
					e.removeClass('fa fa-eye field-icon');
					e.addClass('fa fa-eye-slash field-icon');

				} else {
					x.type = "password";

					e.removeClass('fa fa-eye-slash field-icon');
					e.addClass('fa fa-eye field-icon');

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












		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/toastr.min.js"></script>
		<!--</div>-->



	</html>
	<script>
		$(document).on('ready', function() {
			$(document).on('submit', '#loginform', function(event) {
				event.preventDefault();
				$.ajax({
					url: 'funcs/login.php',
					type: 'POST',
					dataType: 'JSON',
					data: $(this).serialize(),
					success: function(data) {

						toastr.options.timeOut = 2000;
						// toastr.options.showMethod = 'fadeIn';
						// toastr.options.hideMethod = 'fadeOut';
						// toastr.options.positionClass = 'toast-top-center';

						if (data == "ok") {
							toastr.success("Bienvenido a TECNIWASH ");
							setTimeout(function() {
								location.href = "home.php";
							}, 2000);
						} else if (data == "nuevo") {
							toastr.success("Usuario Nuevo , Deberá Responder algunas preguntas de Seguridad");
							setTimeout(function() {
								$.get('funcs/preguntas.php', {
									'option': 'listar'
								}, function(data) {
									$.each(data, function(index, val) {
										$('#pregunta').append('<option value="' + val.id_pregunta + '">' + val.pregunta + '</option>');
									});

								}, 'json');

								$.get('funcs/preguntas.php', {
									'option': 'getTotal'
								}, function(data) {
									totalpre = parseInt(data);
								}, 'json');

								$('#modal').modal({
									backdrop: 'static',
									keyboard: false
								});

							}, 2000);
						} else {
							toastr.error(data);
						}
					}
				})
			});

			$(document).on('submit', '#formpreguntas', function(event) {


				$.ajax({
					url: 'funcs/preguntas.php',
					type: 'POST',
					dataType: 'JSON',
					data: {
						'option': 'guardar',
						'data': $(this).serialize()
					},
					success: function(data) {
						if (data == "ok") {
							toastr.info("Pregunta Guardada Correctamente ." + cont);
							$('#respuesta').val('');
							$("#pregunta option").remove();
							cont++;
							toastr.success("Pregunta Guardada Correctamente ." + cont);
							if (cont < totalpre) {
								$.get('funcs/preguntas.php', {
									'option': 'listar'
								}, function(data) {
									$.each(data, function(index, val) {

										$('#pregunta').append('<option value="' + val.id_pregunta + '">' + val.pregunta + '</option>');
									});

								}, 'json');
							} else {
								$('#modal').modal('hide');
								$.ajax({
									url: 'funcs/preguntas.php',
									type: 'POST',
									dataType: 'JSON',
									data: {
										'option': 'activateUser'
									},
									success: function(data) {
										if (data == "ok")
											location.href = "principal.php";
										else
											toastr.error("Ocurrio un error al Actualizar el Estado");
									}
								})


							}
						} else {
							toastr.warning("No se Pudo guardar la Repuesta");
						}
					}
				})
				event.preventDefault();
			});


























		});
	</script>




<?php

}
?>