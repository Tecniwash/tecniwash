<!-- Modal -->

<?php
//Archivo verifica que el usario que intenta acceder a la URL esta logueado



	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['codigo'])) {
           $errors[] = "codigo vacío";
        } else if (empty($_POST['mas'])){
			$errors[] = "Nombre de mascota";
		} 
	

require '../funcs/conexion.php';
require '../funcs/funcs.php';
		$ser=$_POST["codigo"];
		$costo=$_POST["stock"];

		$num=$_POST["nom"];
		$mas=mysqli_real_escape_string($mysqli,(strip_tags($_POST["mas"],ENT_QUOTES)));
               $ser=strtoupper($ser);
		$cantidad=$_POST["costo"];
		$sql=("INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,num) VALUES ('$ser','$cantidad','$costo','$num')");
    



		/*$sql="INSERT INTO tbl_maser (id_mascota,servicio,costo,num) VALUES ('$mas','$ser','$costo',$num)";*/
		$query_new_insert = mysqli_query($mysqli,$sql);
			if ($query_new_insert){
				$messages[] = "servicio ha sido ingresado satisfactoriamente.";
				
				
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