<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



 if ($_POST['mod_estado']==""){
			$errors[] = "Selecciona el estado del producto";
		} else if (
			!empty($_POST['mod_id']) &&
		
			$_POST['mod_estado']!="" &&
			!empty($_POST['mod_estado'])
		){

		$id_atencion=$_POST['mod_id'];

		$estado=$_POST['mod_estado'];
	
     
     
     
     
     
     
     
     
     
     
     
		$sql="UPDATE tbl_atenciones SET status='".$estado."' WHERE id_atencion='".$id_atencion."'";
		$query_update = mysqli_query($mysqli,$sql);
			if ($query_update){
				$messages[] = "El estado ha sido actualizado satisfactoriamente.";
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