<?php

require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>
<?php

	if (empty($_POST['osb'])) {
           $errors[] = "Parametro vacio";
        }else if (empty($_POST['valors'])) {
           $errors[] = "Valor Vacio";
        } 
         else if (
			!empty($_POST['valors']) &&
			!empty($_POST['valors'])
		){
		/* Connect To Database*/
		//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_parametro=intval($_POST['mod_id']);
		$parametro=mysqli_real_escape_string($mysqli,(strip_tags($_POST["parametros"],ENT_QUOTES)));
		$valor=mysqli_real_escape_string($mysqli,(strip_tags($_POST["valors"],ENT_QUOTES)));

        $obs=$_POST["osb"];
		
			 
			  

         
            
		$sql="UPDATE siec_parametros SET par_nombre='".$parametro."', par_numero='".$valor."' ,par_observacion= '".$obs."' WHERE 	par_id_parametros='".$id_parametro."'";
		$query_update = mysqli_query($mysqli,$sql);

                      
			if ($query_update){
			
			 
				$messages[] = "El parametro ha sido actualizado satisfactoriamente.";
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