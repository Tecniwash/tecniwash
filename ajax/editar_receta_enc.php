<?php
	session_start();




require '../funcs/conexion.php';
require '../funcs/funcs.php';
	$id_atencion= $_SESSION['id_atencion'];
	


if (!empty($_POST['id_atencion']) ){
	
		$id_atencion=intval($_POST['id_atencion']);
		$tratamiento=$_POST['tratamiento'];
		$receta_ex=$_POST['rece_externa'];

		$id_receta= getCualquiera('re_id_receta','siec_receta','re_id_atencion',$id_atencion);
        
		
		$sql="UPDATE siec_receta SET re_tratamiento=	'".$tratamiento."', re_receta_ex='".$receta_ex."' WHERE re_id_atencion='".$id_atencion."'";
		$query_update = mysqli_query($mysqli,$sql);
			if ($query_update){
				$messages[] = "Receta ha sido actualizada satisfactoriamente.";
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