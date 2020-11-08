<?php
/* $post = file_get_contents('php://input');
    echo $post; */
session_start();


if (($_SESSION['id_usuario'])) {
    require '../funcs/conexion.php';
    require '../funcs/funcs.php';
    $idUsuario = $_SESSION['id_usuario'];
    $sql = "Select id_usuario, nombre_usuario from tbl_usuario WHERE id_usuario = '$idUsuario'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
} else {
    header("Location: index.php");
}
?>


<?php

if (empty($_POST['prodictId'])) {
    $errors[] = "ID vacío";
} elseif (
    !empty($_POST['prodictId'])
) {

    $productId = $_POST['prodictId'];
    $a = 3;

    $sql = "DELETE  FROM products WHERE id_producto='" . $productId . "'";
    $query = mysqli_query($mysqli, $sql);
    $objeto = "tbl_productos";
    $accion = "DELETE";
    $descripcion = "ingreso a pantalla productos";

    if ($query) {
        $messages[] = "Producto eliminado con éxito.";
        $bita = grabarBitacora($idUsuario, $objeto, $accion, $sql);
    } else {
        $errors[] = "Lo sentimos , el intento de eliminado falló. Por favor, regrese y vuelva a intentarlo.";
    }
} else {
    $errors[] = "Un error desconocido ocurrió.";
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