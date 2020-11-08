<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>


<?php




if (empty($_POST['nombre'])) {
           $errors[] = " nombre vacia ";  
        
        } else if (empty($_POST['abreviatura'])){
			$errors[] = "abreviatura vacío";
		}  else if (
    // al usar && condicion estricta
			!empty($_POST['abreviatura']) &&
			!empty($_POST['nombre']) 
		){
	
	
			
    $nombre=$_POST["nombre"];
				$abr=$_POST["abreviatura"];				
                
               
    

         
        $sql = "SELECT * FROM  siec_uni_medida WHERE um_nombre = '" .$nombre. "';";
$query_check_user_name = mysqli_query($mysqli,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);    
    
    
					
               	if ($query_check_user == 0 ){
                    
                      $iden = "SELECT * FROM siec_uni_medida WHERE um_descripcion = '" .$abr. "';";
$query_check_iden= mysqli_query($mysqli,$iden);
$query_check_iden=mysqli_num_rows($query_check_iden);     
             
                    
                    
                             		if ($query_check_iden == 0 ){
   $consulta=("INSERT INTO siec_uni_medida( um_nombre, um_descripcion)VALUES('$abr','$nombre')");
					$resultado=mysqli_query($mysqli,$consulta) or die (mysqli_error($mysqli));
            
         
                    // if user has been added successfully
                if ($resultado) {                        
                   
                        $messages[] = "Registro fue creado con éxito.";
                }
                    }else{
                       $errors[] = "esta abreviatura ya esta asiganda a una clinica"; 
                       
                    }
                }else{
              $errors []= "ya hay una unidad registrada con este nombre"; 
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
