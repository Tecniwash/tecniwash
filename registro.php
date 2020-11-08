<?php


require 'funcs/conexion.php';
$consulta = "select id_rol, rol from tbl_roles";
$result = mysqli_query($mysqli, $consulta) or die(mysqli_error($mysqli));

$consulta2 = "select descripcion from tbl_parametros where nombre = 'vencimiento'";
$result2 = mysqli_query($mysqli, $consulta2) or die(mysqli_error($mysqli));
$fss = mysqli_fetch_row($result2);
$vig = $fss[0];
$fecha = date('Y-m-j');
$nuevafecha = strtotime("+$vig day", strtotime($fecha));
$nuevafecha = date('Y-m-j', $nuevafecha);
?>

<!DOCTYPE html>
<html lang="es">

<head>




	<meta charset="utf-8">
	<title></title>

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


	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
	<link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'>


</head>
<script>
	function unspaces() {
		orig = document.form.txt_nc.value;
		nuev = orig.split('  ');
		nuev = nuev.join(' ');
		document.form.txt_nc.value = nuev;
		if (nuev = orig.split(' ').length >= 2);
	}

	function nospaces() {
		orig = document.form.txt_us.value;
		nuev = orig.split(' ');
		nuev = nuev.join('');
		document.form.txt_us.value = nuev;
		if (nuev = orig.split(' ').length >= 2);
	}

	function unosolo() {
		while (txt_nc.value.match(/\s\s/)) txt_nc.value = txt_nc.value.replace('  ', ' ');
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
<center>

	<body id="body">
		<div class="container">
			<div id="signupbox" style="margin-top:50px" class="mainbox col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Reg&iacute;strate</div>
						<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>

					<div class="panel-body">
						<form method="post" action="" id="loginform" class="well form-horizontal">
							<fieldset class="regis">

								<!-- Text input-->

								<div class="form-group">
									<label class="col-md-4 control-label">Nombre Completo:</label>
									<div class="col-md-6 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input maxlength="70" type="text" name="txt_nc" placeholder="Nombre" style="text-transform: uppercase;" id="t" autocomplete="off" autofocus="on" onkeyup="return unspaces()" onkeypress="return soloLetras(event)" class="form-control" onkeypress="return soloLetras(event)" onPaste="return false;" title="nombre Usuario" required>
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
									<label class="col-md-4 control-label">Usuario:</label>
									<div class="col-md-6 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input maxlength="15" type="text" name="txt_us" placeholder="Usuario" style="text-transform: uppercase;" id="t" autocomplete="off" autofocus="on" onkeyup="return nospaces()" onkeypress="return soloLetras(event)" onkeypress="return soloLetras(event)" onPaste="return false;" class="form-control" title="Usuario solo letras" required>
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

								<div class="form-group">
									<label class="col-md-4 control-label">Contraseña:</label>
									<div class="col-md-6 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
											<input maxlength="20" type="password" name="pass1" placeholder="Password" id="t" title="debe contener una mayuscula , numero , signo especial no menor a 8" class="form-control" autocomplete="off" autofocus="on" onkeyup="return nospaces2()" onPaste="return false;" required>
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
									<label class="col-md-4 control-label">Confirmar Contraseña:</label>
									<div class="col-md-6 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
											<input maxlength="20" type="password" name="pass2" placeholder="Confirmar Password" id="t" title="debe ser igual a la Contraseña" class="form-control" autocomplete="off" autofocus="on" onkeyup="return nospaces1()" onPaste="return false;" required>
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

								<!-- Text input-->
								<!-- <div class="form-group">
									<label class="col-md-4 control-label">Rol:</label>
									<div class="col-md-6 selectContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
											<select title="Rol del Usuario" class='form-control' name='rol' id='rol' onchange="load(1);" readonly>
												<?php
												$query_cod_veh = mysqli_query($mysqli, "SELECT id_rol,rol from tbl_roles WHERE id_rol=5");
												while ($rw = mysqli_fetch_array($query_cod_veh)) {
												?>
													<option value="<?php echo $rw['id_rol']; ?>"><?php echo $rw['rol']; ?></option>
												<?php
												}

												?>
											</select>
										</div>
									</div>
								</div> -->


								<!-- Text input-->
								<!-- Text input-->

								<div class="form-group">
									<label class="col-md-4 control-label">E-Mail</label>
									<div class="col-md-6 inputGroupContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
											<input maxlength="80" type="text" name="correo" placeholder="e-mail" id="correo" autocomplete="off" autofocus="on" o class="form-control" onPaste="return false;" required onkeyup=" nospaces3();">
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



								<!-- <div class="form-group">
									<label class="col-md-4 control-label">Estado:</label>
									<div class="col-md-6 selectContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
											<input type="combo_estado" id="combo_estado" name="combo_estado" class="form-control" value="NUEVO" readonly>
										</div>
									</div>
								</div> -->

								<div class="form-group">

									<div class="col-md-6 inputGroupContainer">
										<div class="input-group">

											<input type="hidden" name="fecha1" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly>
										</div>
									</div>
								</div>

								<input type="submit" class="btn btn-success" value="Aceptar" onclick="this.form.action='registrar2.php'" class="btn btn-success">


							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/toastr.min.js"></script>
		<script>
			$(document).on('ready', function() {


				$(document).on('submit', '#loginform', function(event) {
					event.preventDefault();
					$.ajax({
						url: 'registrar_auto.php',
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
									location.href = "index.php";
								}, 3000);
							} else {
								toastr.error(data);
							}
						}
					})
				});



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



	</body>
</center>

</html>