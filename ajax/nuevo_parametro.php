

<?php
require '../funcs/conexion.php';
require '../funcs/funcs.php';
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
		
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['parametro'])) {
           $errors[] = "parametro vacío";
        } else if ((empty($_POST['valor']))or (empty($_POST['texto']))){
			$errors[] = "Nombre del valor vacío o texto vacio";
		} 
		

		
		$parametro=mysqli_real_escape_string($mysqli,(strip_tags($_POST["parametro"],ENT_QUOTES)));
		$valor=mysqli_real_escape_string($mysqli,(strip_tags($_POST["valor"],ENT_QUOTES)));
		

        $obs= $_POST["osb"];
		
		$sql="INSERT INTO siec_parametros(par_nombre,par_numero,par_observacion) VALUES ('$parametro','$valor','$obs')";
		$query_new_insert = mysqli_query($mysqli,$sql);
			if ($query_new_insert){
				$messages[] = "registrado satisfactoriamente.";
				
				
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($mysqli);
			
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