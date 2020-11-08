<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>


<?php




if (empty($_POST['nombre'])) {
           $errors[] = " nombre vacia ";  
        
        } else if (empty($_POST['telefono'])){
			$errors[] = "telefono vacío";
		} else if (empty($_POST['region'])){
			$errors[] = "region no seleccionado";
        } else if (empty($_POST['direccion'])){
			$errors[] = "direccion vacia";  
    
   } else if (empty($_POST['direccion'])){
			$errors[] = "direccion vacia";  
    

        
        } else if (
    // al usar && condicion estricta
			!empty($_POST['direccion']) &&
			!empty($_POST['nombre']) 
		){
	
	
			
    $nombre=$_POST["nombre"];
				$dir=$_POST["direccion"];				
                $telefono = $_POST["telefono"];				
				$region=$_POST["region"];
               
    

         
        $sql = "SELECT * FROM  siec_clinicas WHERE cli_nombre = '" .$nombre. "';";
$query_check_user_name = mysqli_query($mysqli,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);    
    
    
					
               	if ($query_check_user == 0 ){
                    
                      $iden = "SELECT * FROM siec_clinicas WHERE cli_direccion = '" .$dir. "';";
$query_check_iden= mysqli_query($mysqli,$iden);
$query_check_iden=mysqli_num_rows($query_check_iden);     
             
                    
                    
                             		if ($query_check_iden == 0 ){
   $consulta=("INSERT INTO siec_clinicas(cli_nombre, cli_telefono, cli_direccion,cli_region) VALUES('$nombre','$telefono','$dir','$region')");
					$resultado=mysqli_query($mysqli,$consulta) or die (mysqli_error($mysqli));
            
         
                    // if user has been added successfully
                if ($resultado) {                        
                   
                        $messages[] = "clinica fue creado con éxito.";
                }
                    }else{
                       $errors[] = "esta direccion ya esta asiganda a una clinica"; 
                       
                    }
                }else{
              $errors []= "ya hay una clinica registrada con este nombre"; 
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
