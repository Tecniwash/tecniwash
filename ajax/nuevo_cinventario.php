<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';


session_start();




if (empty($_POST['codigo'])) {
           $errors[] = " codigo vacio ";  
        
		} else if ($_POST['nombre']==""){
			$errors[] = "nombre vacío";
        } else if (empty($_POST['clasificacion'])){
			$errors[] = "no ha seleccionado una clasificación";
		} else if (empty($_POST['uni_medida'])){
			$errors[] = "no ha seleccionado una unidad de medida";
        } else if (empty($_POST['presentacion'])){
			$errors[] = "presentacion vacia";
    

        
        } else if (
			!empty($_POST['codigo']) &&
			!empty($_POST['nombre']) 
		){
	
	
				// escaping, additionally removing everything that could be (html/javascript-) code
             // $temporal=$_POST["temporal"];
				$codigo=$_POST["codigo"];
                $nombre=$_POST["nombre"];
				$clasificacion=$_POST["clasificacion"];				
                $uni_medida = $_POST["uni_medida"];				
				$presentacion=$_POST["presentacion"];
               $id_emple=$_SESSION["id_usuario"];
    			

    

     
    
    
    

					
                $consulta=("INSERT INTO siec_inventario (inv_codigo,inv_nombre_producto,inv_id_clasificacion,inv_id_um,inv_presentacion) 
                VALUES('$codigo','$nombre', '$clasificacion', '$uni_medida','$presentacion' )");
					$resultado=mysqli_query($mysqli,$consulta) or die (mysqli_error($mysqli));
            
         
                    // if user has been added successfully
                if ($resultado) {                        
                   
                        $messages[] = "Registro fue creado con éxito.";
               
                    
         }else{
                       $errors[] = "error desconocido"; 
                       
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
}
?>
