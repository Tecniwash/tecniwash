
<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>

<?php
	
	if (empty($_POST['mod_id'])) {
           $errors[] = "id vacío";
        }
         else if (
			!empty($_POST['mod_id'])
		){

			$id_permiso=$_POST['mod_id'];

	
             
             
             
   
      
            

          $sql="DELETE FROM siec_permisos WHERE per_id_permiso='".$id_permiso."' ";
		

		$query_update = mysqli_query($mysqli,$sql);
		
                      
			if ($query_update){
				 
			 
				$messages[] = "El registro ha sido eliminado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($mysqli);
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








































