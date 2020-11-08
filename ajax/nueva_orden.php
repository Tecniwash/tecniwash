<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>

<?php
	//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['num'])) {
           $errors[] = "id_compra vacío";
        }else if (empty($_POST['tran'])) {
           $errors[] = "trans vacío";
        }else if (empty($_POST['fecha'])) {
           $errors[] = "fecha vacío";         
        }else if (empty($_POST['codigo'])) {
           $errors[] = "codigo vacío";
        } else if (empty($_POST['precio'])) {
           $errors[] = "precio vacío";
        
        
        }  
   
         else if (
             
            !empty($_POST['tran']) 
			
		){
		/* Connect To Database*/
		//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id=$_POST["tran"];
         $id_prove=$_POST["id_proveedor"];
		$fecha=$_POST["fecha"];
             $codigo=$_POST['codigo'];
		$cantidad=$_POST['num'];
		$precio = $_POST["precio"];
	   $stock=$_POST['total_stock'];
		$tipo_transaccion=$_POST["transaccion"];
            $sql=( "INSERT INTO transaccion_productos(codigo_transaccion,id_proveedor,fecha,codigo,numero,tipo_transaccion,stock) 
                                            VALUES('$id','$id_prove','$fecha','$codigo','$cantidad','$tipo_transaccion','$stock')");
		$query_update = mysqli_query($mysqli,$sql);
		
                $query1 = mysqli_query($mysqli, "UPDATE products SET cant= '$stock'
                                                              WHERE codigo_producto= '$codigo'")
                                                or die('Error: '.mysqli_error($mysqli));
                      
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