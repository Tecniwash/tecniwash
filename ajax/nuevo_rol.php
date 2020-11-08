<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>


<?php

session_start();

if (empty($_POST['nombre'])) {
           $errors[] = " nombre vacio ";  
        
		
        } else if (empty($_POST['desc'])){
			$errors[] = "descripcion vacia";  
    
 
    

        
        } else if (!empty($_POST['nombre']) &&
			!empty($_POST['desc']) 
		){
	
	
			
    $desc=$_POST['desc'];
				$nombre=$_POST["nombre"];				
             

    
    
    //if ($temporal== "" or $temporal!= "1"){
    
    
         
        $sql = "SELECT * FROM siec_roles WHERE rol_nombre= '" .$nombre. "';";
$query_check_user_name = mysqli_query($mysqli,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);    
    
    
					
               	if ($query_check_user == 0 ){

             
                    
                    
                             	
                    
                    
                    
					
                    $consulta=("INSERT INTO siec_roles (rol_nombre
                    ,rol_descripcion) 
                    VALUES('$nombre','$desc')");
					$resultado=mysqli_query($mysqli,$consulta) or die (mysqli_error($mysqli));
            
         
                    // if user has been added successfully
                if ($resultado) {                        
                   
                        $messages[] = "rol fue creado con éxito.";
                }
                  
                }else{
              $errors []= "este nombre de rol ya existe"; 
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
