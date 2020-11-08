

<?php

		if (empty($_POST['consul_id'])){
			$errors[] = "Consulta Vacia";
		 
        }  elseif (
			 !empty($_POST['consul_id'])
			
        ) {
            require '../funcs/conexion.php';
require '../funcs/funcs.php';
			
				$id_consulta=$_POST['consul_id'];
			
				
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				
					
               
					// write new user's data into database
                    $sql = "DELETE  FROM tmp WHERE id_tmp='".$id_consulta."'";
                    $query = mysqli_query($mysqli,$sql);

                    // if user has been added successfully
		if ($query) {
						
                        $messages[] = "La consulta ha sido eliminada con éxito.";
                    } else {
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


































