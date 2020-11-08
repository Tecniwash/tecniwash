











<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>

<?php
	
	if (empty($_POST['mod_id'])) {
           $errors[] = "usuario vacío";
        }else if (empty($_POST['pass'])) {
           $errors[] = "pass vacío";
         
        }else if (empty($_POST['repass'])) {
           $errors[] = "repeticion del pass vacío";
        }  
         
   
         else if (
			!empty($_POST['mod_id'])
		){

			$id_usuario=$_POST['mod_id'];

		$pass=$_POST['pass'];
     $repass=$_POST['repass'];
	
     
			  	$peticion="1";
			 
	
                $fecha=date("y/m/d");
          
             
             
             
             
             
             
             
   	$new_pass= password_hash($pass, PASSWORD_DEFAULT);
    
       if((strlen($pass) > 8) &&($pass==$repass)){
            

          $sql="UPDATE siec_usuarios SET usu_pass='".$new_pass."' ,fecha_cambio_contrasena ='".$fecha."' ,usu_peticion_pass='".$peticion."' WHERE usu_id_usuario='".$id_usuario."'";
		

		$query_update = mysqli_query($mysqli,$sql);
		
                      
			if ($query_update){
				 
			 
				$messages[] = "El registro ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($mysqli);
            }
			
             }else{
              $errors []= "la clave debe ser mayor de 8 caracteres y  ser iguales"; 
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








































