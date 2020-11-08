<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>

<?php
	
	if (empty($_POST['id_enfermedad'])) {
           $errors[] = "id vacío";
        
        }else if (empty($_POST['nomb'])) {
           $errors[] = "nombre vacío";
        } else if (empty($_POST['des'])) {
           $errors[] = "descripcion  vacío";
        

        }      
   
         else if (
			!empty($_POST['id_enfermedad'])
		){

	$nombre=$_POST["nomb"];
				$des=$_POST["des"];				
                
			 $id=$_POST['id_enfermedad'];
	
             
             
             
        $sql = "SELECT * FROM siec_enfermedad WHERE enf_enfermedad = '" .$nombre. "' and enf_id_enfermedad!='" .$id. "' ;";
$query_check_user_name = mysqli_query($mysqli,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);     
             
             
             
             
             
             
             
             
             
             
             
             
             
	

		if ($query_check_user == 0 ){
            
  
            
		$sql="UPDATE siec_enfermedad SET enf_enfermedad='".$nombre."',enf_descripcion= '".$des."' WHERE enf_id_enfermedad='".$id."'";
		$query_update = mysqli_query($mysqli,$sql);
		
                      
			if ($query_update){
				 
			 
				$messages[] = "El registro ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($mysqli);
            }
			 
             
             }else{
              $errors []= "ya existe este nombre en la enfermedad"; 
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