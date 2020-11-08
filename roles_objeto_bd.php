
<script src="./dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="./dist/sweetalert.css">


<?php require("funcs/conexion.php");
	$user_id = $_SESSION['id_usuario'];

/*BOTON GUARDAR */
if (isset($_POST['btn_guardar'])) {

if ( (empty($_POST['combo_roles'])) OR (empty($_POST['combo_objeto']))  ) {

if (isset($_POST['combo_roles'])) {
$_idrol = $_POST['combo_roles'];
}else{
$_idrol = null;    
}

if (isset($_POST['combo_objeto'])) {
$_idobjeto = $_POST['combo_objeto'];
}else{
$_idobjeto = null;    
}
 ?>
<script>
        function(isConfirm) {
            if (isConfirm) {
                var v = document.getElementById("combo_roles");  
                var g = document.getElementById("combo_objeto");
            v.style.borderColor = 'red';
            g.style.borderColor = 'red';
            var roles = "<?php echo $_idrol; ?>";
            var objeto = "<?php echo $_idobjeto; ?>";
    document.getElementById('combo_roles').value = roles;
    document.getElementById('combo_objeto').value = objeto;
            } 
        };
</script>
<?php 

}
 
else{
    if (1 == true) {

$_idrol = $_POST['combo_roles'];
$_idobjeto = $_POST['combo_objeto'];
//$id_usuario_sesion = $_SESSION['id_usuario_sesion'];

if (isset($_POST['ck_consultar' ])) {
 $_permiso_consulta = '1';
 }else{
$_permiso_consulta = '0';
}
if (isset($_POST['ck_eliminar' ])) {
 $_permiso_eliminar = '1';
 }else{
$_permiso_eliminar = '0';
}
if (isset($_POST['ck_actualizar' ])) {
 $_permiso_actualizar = '1';
}else{
$_permiso_actualizar = '0';
}
if (isset($_POST['ck_insertar' ])) {
 $_permiso_insertar ='1';
}else{
$_permiso_insertar = '0';
}

$comparar_rol = "SELECT * FROM permisos WHERE  per_id_pantalla = '$_idobjeto' and per_id_rol= $_idrol ";
      
$result = $mysqli->query($comparar_rol);

if ($result->num_rows > 0) {

    ?>
<script type="text/javascript">
    sweetAlert("ya existe este registro de permiso en esta pantalla en este rol "); 
</script>
<?php 


}
else{

$sql = "INSERT INTO permisos (	per_id_rol,per_id_pantalla,per_consulta,per_insercion,per_actualizacion,per_eliminacion, per_usu_modi)
VALUES ('$_idrol','$_idobjeto','$_permiso_consulta','$_permiso_insertar','$_permiso_actualizar','$_permiso_eliminar', '$user_id')";

if ($mysqli->query($sql) == TRUE) {
        ?>
<script>
swal({
            title: 'Datos Guardados Con Exito!',
            text: '',
            type: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
              
            } 
        });
</script>
<?php 

} 
}
}
}
}
/*TERMINA BOTON GUARDAR PERMISO*/


/*BOTON ELIMINAR*/
if (isset($_POST['btn_eliminar'])) {
    
    
$eli=$_POST['moda'];

                        $sql = "DELETE  FROM tbl_roles_objeto WHERE id_permiso = $eli";
    
    $mysqli->query($sql);

        ?>
    
        <script>
            
swal({
            title: 'Eliminado con exito !',
            text: '',
            type: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
               
            } 
        });
</script>
        <?php
}

/*TERMINA BOTON ELIMINAR*/


/*BOTON IMPRIMIR*/
if (isset($_POST['btn_imprimir'])) {

        ?>
        <script>
swal({
            title: 'Este Botón se Encuentra Inhabilitado  !',
            text: '',
            type: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
               
            } 
        });
</script>
        <?php
}
/*TERMINA BOTON IMPRIMIR*/

?>

