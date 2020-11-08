<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>


<?php




if (empty($_POST['identidad'])) {
           $errors[] = " identidad vacío";
        } else if (empty($_POST['nombre'])){
			$errors[] = "Nombre del producto vacío";
		} else if ($_POST['apellido']==""){
			$errors[] = "apellido vacío";
		} else if (empty($_POST['correo_electronico'])){
			$errors[] = "correo_electronico vacío";
        } else if (empty($_POST['celular'])){
			$errors[] = "celular vacío";
		}  else if (empty($_POST['membresia'])){
			$errors[] = "membresia vacío";
		} else if (empty($_POST['direccion'])){
			$errors[] = "direccion vacío";
		}


		 else if (
			!empty($_POST['identidad']) &&
			!empty($_POST['nombre']) &&
			$_POST['membresia']!=""
		){
	
	
				// escaping, additionally removing everything that could be (html/javascript-) code
              
				$id=$_POST["identidad"];
				$nombre=$_POST["nombre"];				
                $ape = $_POST["apellido"];				
				$correo=$_POST["correo_electronico"];
    			$cel= $_POST["celular"];
    			$tel= $_POST["telefono"];
               $mem=$_POST["membresia"];
               $dir=$_POST["direccion"];
               
               
                // check if user or email address already exists
			         $nombre= strtoupper($nombre);
					$ape= strtoupper($ape);
			         $mem= strtoupper($mem);
					$dir= strtoupper($dir);

					// write new user's data into database
                if (preg_match('/\w+@\w+\.+[a-z]/', $correo)){
					
                    $consulta=("INSERT INTO tbl_clientes(nom_cliente,identidad,ape_cliente,cor_cliente,celular,telefono,direccion,membresia) VALUES('$nombre', '$id', '$ape','$correo','$cel','$tel','$dir','$mem')");
					$resultado=mysqli_query($mysqli,$consulta) or die (mysqli_error($mysqli));
            
         
                    // if user has been added successfully
                if ($resultado) {                        
                   
                        $messages[] = "La registro creado con éxito.";
                }
                    }else{
                       $errors[] = "El formato del correo es invalido,  ==>> correo@ejemplo.com."; 
                       
                    }
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
                    
?>
