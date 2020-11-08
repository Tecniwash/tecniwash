<?php

require 'conexion.php';
require 'funcs.php';

session_start();



function crear_menu($id_padre, $rol)
{
	global $mysqli;
	$test = "numero";
	$hijo = " hijo ";
	$menu = ""; // Vaciamos la variable menú
	$rol = $_SESSION['id_rol'];

	$consulta = "SELECT * FROM (sELECT M.menu_id, M.menu_nombre, M.id_padre ,M.link,M.logo , M.li_class , M.ul_class , M.ul_cerrar fROM permisos P inner join menu M on M.menu_id= P.per_id_pantalla inner join roles R on R.rol_id_rol= P.per_id_rol where P.per_id_rol=$rol UNION SELECT ME.menu_id,ME.menu_nombre,ME.id_padre,ME.link,ME.logo , ME.li_class,  ME.ul_class , ME.ul_cerrar from permisos PE ,menu ME WHERE ME.menu_id IN (SELECT distinct id_padre fROM permisos PR inner join menu MR on MR.menu_id= PR.per_id_pantalla inner join roles RE on RE.rol_id_rol= PR.per_id_rol where PR.per_id_rol=$rol ) GROUP by ME.menu_nombre) as tab where id_padre= $id_padre order by menu_id asc";
	//$consulta = " SELECT * FROM menu where estatus='1' and id_padre=" ;


	$resultado = mysqli_query($mysqli, $consulta);


	while ($row = mysqli_fetch_array($resultado)) {
		// echo $test;
		//  $row_cnt = mysqli_num_rows($resultado);
		// echo $row_cnt;

		$menu .= "<li " . $row['li_class'] . " ><a href='" . $row['link'] . "'><i class='" . $row['logo'] . "'></i>" . $row['menu_nombre'];

		$row_cnt = mysqli_num_rows($resultado);
		//echo $row_cnt;
		//if ( $row_cnt  = 0){
		$menu .= " " . $row['ul_class'] . " " . crear_menu($row['menu_id'], $rol) . $row['ul_cerrar']; //LLamada recursiva para generar todos los niveles del menú 
		//}
		$menu .= "</li>";
	}

	return $menu;
}













$usuario = $_POST['usuario'];
$clave = $_POST['password'];

$sentencia = $mysqli->prepare("SELECT fecha_cambio_contrasena from tbl_usuario where usuario= ?");
$sentencia->bind_param("s", $usuario);
$sentencia->execute();
$result = $sentencia->get_result();
while ($row = $result->fetch_assoc()) {
	$fechacontra = $row['fecha_cambio_contrasena'];
}
$sentencia->free_result();
$sentencia->close();





$sentencia = $mysqli->prepare("SELECT descripcion FROM tbl_parametros where id_parametro=1");
$sentencia->execute();
$result  = $sentencia->get_result();
while ($row = $result->fetch_assoc()) {
	$dias_vence = $row['descripcion'];
}
$sentencia->free_result();
$sentencia->close();




$sentencia = $mysqli->prepare("SELECT descripcion FROM tbl_parametros where id_parametro=8");
$sentencia->execute();
$result  = $sentencia->get_result();
while ($row = $result->fetch_assoc()) {
	$intentostotal = $row['descripcion'];
}
$sentencia->free_result();
$sentencia->close();

$sentencia = $mysqli->prepare("SELECT usuario from tbl_usuario where usuario = ? or correo_electronico= ?");
$sentencia->bind_param("ss", $usuario, $usuario);
$sentencia->execute();
$sentencia->store_result();
$row_cnt = $sentencia->num_rows;


$sentencia->free_result();
$sentencia->close();





if ($row_cnt > 0) {
	$sentencia = $mysqli->prepare("SELECT id_usuario , id_rol,usuario,nombre_usuario,intentos,estado_usuario,contrasena,activacion from tbl_usuario where usuario = ? or 
		correo_electronico= ?");
	$sentencia->bind_param("ss", $usuario, $usuario);
	$sentencia->execute();


	$result  = $sentencia->get_result();

	while ($row = $result->fetch_assoc()) {
		$iduser = $row['id_usuario'];
		$idrol = $row['id_rol'];
		$user = $row['usuario'];
		$intentos = $row['intentos'];
		$passwd = $row['contrasena'];
		$name = $row['nombre_usuario'];
		$estado_usuario = $row['estado_usuario'];
		$activacion = $row['activacion'];
	}

	$sentencia->free_result();
	$sentencia->close();




	if ($iduser == 1) {

		$validaPassw = password_verify($clave, $passwd);

		if ($validaPassw) {


			$_SESSION['id_usuario'] = $iduser;
			$_SESSION['user_login_status'] = 1;
			$_SESSION['id_rol'] = $idrol;
			$_SESSION['usuario'] = $user;
			$_SESSION['nombre_usuario'] = $name;
			$_SESSION['estado_usuario'] = strtolower($estado_usuario);
			$_SESSION['menus'] = crear_menu(0, $idrol);
		

			echo json_encode("ok");
		} else {

			echo json_encode("Datos Incorrectos ");
		}
	} elseif ($activacion == 1) {






		if ($intentos < $intentostotal) {

			$validaPassw = password_verify($clave, $passwd);

			if ($validaPassw) {
				$sentencia = $mysqli->prepare("UPDATE tbl_usuario set intentos = 0 where id_usuario = ?");
				$intentos += 1;
				$sentencia->bind_param("i", $iduser);
				$sentencia->execute();
				$sentencia->free_result();
				$sentencia->close();

				$_SESSION['id_usuario'] = $iduser;
				$_SESSION['user_login_status'] = 1;
				$_SESSION['id_rol'] = $idrol;
				$_SESSION['usuario'] = $user;
				$_SESSION['nombre_usuario'] = $name;
				$_SESSION['menus'] = crear_menu(0, $idrol);
				$_SESSION['estado_usuario'] = strtolower($estado_usuario);




				if (strtolower($estado_usuario) == strtolower('nuevo')) {

					//echo json_encode("nuevo");
					echo json_encode("ok");
				} else
					echo json_encode("ok");
			} else {
				$sentencia = $mysqli->prepare("UPDATE tbl_usuario set intentos = ? where id_usuario = ?");
				$intentos += 1;
				$sentencia->bind_param("ii", $intentos, $iduser);
				$sentencia->execute();
				$sentencia->free_result();
				$sentencia->close();
				echo json_encode("Datos Incorrectos , le quedan  " . ($intentostotal - ($intentos) . " intentos."));
			}
		} else {
			echo json_encode("Ha Excedido el Limite de Intentos ");

			$sentencia = $mysqli->prepare("UPDATE tbl_usuario set activacion = 0  where id_usuario = ?");
			$sentencia->bind_param("i", $iduser);
			$sentencia->execute();
			$sentencia->free_result();
			$sentencia->close();
			$estado = "BLOQUEADO";

			$sentencia = $mysqli->prepare("UPDATE tbl_usuario set estado_usuario = ? where id_usuario = ?");
			$sentencia->bind_param("si", $estado, $iduser);
			$sentencia->execute();
			$sentencia->free_result();
			$sentencia->close();
		}
	} else {
		echo json_encode("BLOQUEADO O INACTIVO");
	}
} else {
	echo json_encode("Usuario o  Correo Electronico no Registrados");
}
