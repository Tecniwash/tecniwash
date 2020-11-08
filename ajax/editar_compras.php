<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>

<?php
	//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id_compra'])) {
           $errors[] = "id_compra vacío";
        }else if (empty($_POST['id_proveedor'])) {
           $errors[] = "id_proveedor vacío";
        }else if (empty($_POST['des'])) {
           $errors[] = "descripcion vacío";         
    } else if (empty($_POST['precio'])) {
           $errors[] = "precio vacío";
      
        
        }  
   
         else if (
             
            !empty($_POST['id_compra']) 
			
		){
		/* Connect To Database*/
		//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id=$_POST["id_compra"];
         $id_compra=$_POST["id_proveedor"];
		$descripcion=strtoupper($_POST["des"]);
		$cantidad=$_POST["cantidad"];
		$precio = $_POST["precio"];
	
		
    			
            
		$sql="UPDATE products SET codigo_producto='".$id_compra."',nombre_producto='".$descripcion."',cant='".$cantidad."', precio_producto='".$precio."' WHERE id_producto='".$id."'";
		$query_update = mysqli_query($mysqli,$sql);
		
                      
			if ($query_update){
				 
			 
			 
				$messages[] = "El producto ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($mysqli);
			}
		} else {
			$errors []= "Error desconocido.".mysqli_error($mysqli);
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