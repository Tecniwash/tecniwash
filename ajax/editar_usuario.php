<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>

<?php
	
	if (empty($_POST['usuario'])) {
           $errors[] = "nombre usuario vacío";
        }
         
   
         else if (
			!empty($_POST['usuario'])
		){

		$id_usuario=$_POST['id_usuario'];
        $usuario=$_POST['usuario'];
             $estado=$_POST['tipo'];

			 $rol=$_POST['combo_roles'];
			 
			
	
             
             
             
        $sql = "SELECT * FROM siec_usuarios WHERE usu_username = '" .$usuario. "'  and usu_id_usuario!='" .$id_usuario. "' ;";
$query_check_user_name = mysqli_query($mysqli,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);     
             
             
             
             
             
             
             
             
             
             
             
             
             
	

		if ($query_check_user == 0 ){
            
            
                      
 if ($estado=="INACTIVO"){
     
     $act="0";
     
 }else{
     
     $act="1";
 }
            
        
            
		$sql="UPDATE siec_usuarios SET usu_username='".$usuario."',  estado_usuario ='".$estado."', activacion='".$act."', usu_id_rol='".$rol."' WHERE usu_id_usuario='".$id_usuario."'";
		$query_update = mysqli_query($mysqli,$sql);
		
                      
			if ($query_update){
				 
			 
				$messages[] = "El registro ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($mysqli);
            }
			 
             
             }else{
              $errors []= "este nomnbre de usuario pertenece a otro empleado"; 
             }
             
             
             
             
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
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
			if (isset($messages)){
				
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