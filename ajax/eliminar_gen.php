<?php
/* $post = file_get_contents('php://input');
    echo $post; */
session_start();


if (($_SESSION['id_usuario'])) {
    require '../funcs/conexion.php';
    require '../funcs/funcs.php';
    $idUsuario = $_SESSION['id_usuario'];
   
} else {
    header("Location: index.php");
}
?>


<?php

$POST = file_get_contents('php://input');
echo $POST;
$tabla= $_POST['tabla'];
$campo= $_POST['campo'];
$id=$_POST['user_id_mod'];

/*
    $productId = $_POST['prodictId'];
    $a = 3;

    $sql = "DELETE  FROM tbl_productos WHERE id_productos='" . $productId . "'";
    $query = mysqli_query($mysqli, $sql);
    $objeto = "tbl_productos";
    $accion = "DELETE";
    $descripcion = "ingreso a pantalla productos";
*/

  $des =  BorrarGen($tabla,$campo,$id);

    if ($des) {
        $messages[] = "Registro eliminado con éxito.";
        $bita = grabarBitacora($idUsuario, $objeto, $accion, $sql);
    } else {
        $errors[] = "Lo sentimos , el intento de eliminado falló. Por favor, regrese y vuelva a intentarlo.";
    }


if (isset($errors)) {

?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>
<?php
}
if (isset($messages)) {

?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
<?php
}

?>