<?php

session_start();


	require '../funcs/conexion.php';
require '../funcs/funcs.php';
	$idUsuario =$_SESSION['id_usuario'];



?>
<?php
	//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['df'])) {
           $errors[] = "id vacio";
       
        } 
         else if (
			!empty($_POST['df']) 
		){
		/* Connect To Database*/
		//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_parametro=intval($_POST['df']);
		$parametro=$_POST["inser"];
		$valor=$_POST["edi"];
				$valor=$_POST["edi"];
		$eli=$_POST["eliminar"];
             $con=$_POST["con"];
		
			 
			   
			  $objeto="tbl_parametros";
                     $us="probando";
                    $accion="UPDATE";
         
            
		$sql="UPDATE siec_permisos set per_consulta='".$con."', per_insercion='".$parametro."' , per_actualizacion='".$valor."', per_eliminacion='".$eli."' WHERE per_id_permiso='".$id_parametro."'";
		$query_update = mysqli_query($mysqli,$sql);
		 $id= 1;
                      
			if ($query_update){
				 
			 
				$messages[] = "El registro ha sido actualizado satisfactoriamente.";
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