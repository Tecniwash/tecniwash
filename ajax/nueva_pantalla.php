<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>


<?php




if (empty($_POST['nombre'])) {
           $errors[] = " nombre vacia ";  
        
        } else if (empty($_POST['desc'])){
			$errors[] = "agrege una breve descripcion";
		
    
   
        
        } else if (
    // al usar && condicion estricta
			!empty($_POST['nombre']) &&
			!empty($_POST['desc']) 
		){
	
	
			
    $nombre=$_POST["nombre"];
				$des=$_POST["desc"];				
               
               
    

         
        $sql = "SELECT * FROM  siec_pantallas WHERE pant_nombre = '" .$nombre. "';";
$query_check_user_name = mysqli_query($mysqli,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);    
    
    
					
               	if ($query_check_user == 0 ){
                    
                      
   $consulta=("INSERT INTO siec_pantallas (pant_nombre , pant_descripcion) VALUES('$nombre','$des')");
					$resultado=mysqli_query($mysqli,$consulta) or die (mysqli_error($mysqli));
            
         
                    // if user has been added successfully
                if ($resultado) {                        
                   
                        $messages[] = "pantalla registrada con éxito.";
                }
                    
                }else{
              $errors []= "ya esta registrada esta pantalla"; 
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
