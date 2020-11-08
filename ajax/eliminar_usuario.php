<?php

session_start();


if(($_SESSION['id_usuario'])){
	require '../funcs/conexion.php';
require '../funcs/funcs.php';
	$idUsuario = $_SESSION['id_usuario'];
$sql = "Select id_usuario, nombre_usuario from tbl_usuario WHERE id_usuario = '$idUsuario'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
	
	
  
}else{
	  header ("Location: index.php");
}


?>
		

		<?php

		if (empty($_POST['user_id_mod'])){
			$errors[] = "ID vacío";
		 
        }  elseif (
			 !empty($_POST['user_id_mod'])
			
        ) {
			
				$user_id=$_POST['user_id_mod'];
			
				$a=3;
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				
					
               
					// write new user's data into database
                 

                    // if user has been added successfully
			
			if ($user_id==1){
				
				
				      
                        $errors[] = "Lo sentimos ,No puedes eliminar al ADMINISTRADOR.";
                    }else {
						   $sql = "DELETE  FROM tbl_usuario WHERE id_usuario='".$user_id."'";
                    $query = mysqli_query($mysqli,$sql);
				

		         $objeto="tbl_usuario";
		          $accion="DELETE";
		         $descripcion="ingreso a pantalla usuarios";
		
		         
                     //   $messages[] = "usuario ha sido eliminado con éxito.";
                    } //elseif ($query) {
                        //$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                   // }
				
				   
				   if ($query){
					
						   
					$messages[] = "usuario ha sido eliminado con éxito.";
					$bita=grabarBitacora($idUsuario,$objeto,$accion,$sql);
			
	   
				   }else{

					$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
				   }




            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
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