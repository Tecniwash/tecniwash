<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>

<?php
	
	if (empty($_POST['mod_id'])) {
           $errors[] = "seleccione un rol";
        }else if (empty($_POST['roles'])) {
           $errors[] = "rol vacío";
         
        }else if (empty($_POST['des'])) {
           $errors[] = "descripcion vacío";
        } 
   
         else if (
			!empty($_POST['mod_id'])
		){

		$id=$_POST['mod_id'];
		$nombre=$_POST["roles"];
		$des=$_POST["des"];


			 
			 
	
             
             
             
        $sql = "SELECT * FROM siec_roles WHERE rol_nombre = '" .$nombre. "' and rol_id_rol!='" .$id. "' ;";
$query_check_user_name = mysqli_query($mysqli,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);     
             
             
             
             
             
             
             
             
             
             
             
             
             
	

		if ($query_check_user == 0 ){
            
            
                      

            
		$sql="UPDATE siec_roles SET rol_nombre='".$nombre."',rol_descripcion= '".$des."' WHERE rol_id_rol='".$id."'";
		$query_update = mysqli_query($mysqli,$sql);
		
                      
			if ($query_update){
				 
			 
				$messages[] = "El registro ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($mysqli);
            }
			
             
             }else{
              $errors []= "este nombre rol ya existe"; 
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