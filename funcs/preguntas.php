<?php 

require 'conexion.php';
session_start();





if(isset($_GET['option']) && $_GET['option']=='listar'){
	$sentencia = $mysqli->prepare("SELECT p.id_pregunta, p.pregunta FROM tbl_preguntas p
WHERE p.id_pregunta NOT IN(SELECT id_pregunta from tbl_respuestas where id_usuario= ? )");

	$sentencia->bind_param("i", $_SESSION['id_usuario']);
	$sentencia->execute();
	$result  = $sentencia->get_result();
	$row_cnt = $result->num_rows;
	$resultado=  array();
	 while ($row = $result->fetch_assoc()) {
	    $resultado[] = $row;
	}

	$sentencia->free_result();
	$sentencia->close();

	echo json_encode($resultado);
}

else if(isset($_POST['option']) && $_POST['option']=='guardar'){
	$params = array();
	parse_str($_POST['data'], $params);
	$iduser = $_SESSION['id_usuario'];
	$pregunta = $params['pregunta'];
	$respuesta = $params['respuesta'];
	$sentencia = $mysqli->prepare("INSERT INTO tbl_respuestas (id_usuario,id_pregunta,respuesta) VALUES (?,?,?)");
	$sentencia->bind_param("iis", $iduser,$pregunta,$respuesta);

	$isOk= $sentencia->execute();

	$sentencia->free_result();
	$sentencia->close();
	if($isOk)
		echo json_encode("ok");
	else
		echo json_encode("error");
}

else if(isset($_GET['option']) && $_GET['option']=='getTotal'){

	$sentencia = $mysqli->prepare("SELECT descripcion FROM tbl_parametros where id_parametro=9");
	$sentencia->execute();
	$result  = $sentencia->get_result();
	 while ($row = $result->fetch_assoc()) {
	    $totalpreguntas = $row['descripcion'];
	}
	$sentencia->free_result();
	$sentencia->close();

	echo json_encode((int)$totalpreguntas);
}

else if(isset($_GET['option']) && $_GET['option']=='countrespond'){

	$sentencia = $mysqli->prepare("SELECT count(*) as count FROM tbl_respuestas where id_usuario=?");
	$iduser = $_SESSION['id_usuario'];
	$sentencia->bind_param("i", $iduser);
	$sentencia->execute();
	$result  = $sentencia->get_result();
	 while ($row = $result->fetch_assoc()) {
	    $total = $row['count'];
	}
	$sentencia->free_result();
	$sentencia->close();

	echo json_encode((int)$total);
}


/* Update Activo Usuario */
else if(isset($_POST['option']) && $_POST['option']=='activateUser'){

	$sentencia = $mysqli->prepare("UPDATE tbl_usuario set estado_usuario= 'ACTIVO' where id_usuario = ?");
	$iduser = $_SESSION['id_usuario'];
	$sentencia->bind_param("i", $iduser);
	$istrue = $sentencia->execute();
	
	$sentencia->free_result();
	$sentencia->close();
	if($istrue)
		echo json_encode("ok");
	else
		echo json_encode("Error al Actualizar los Datos");
}

 ?>