<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>

<?php
	
	if (empty($_POST['id_clinica'])) {
           $errors[] = "id_clinica vacío";
        
        }else if (empty($_POST['nomb'])) {
           $errors[] = "nombre vacío";
        } else if (empty($_POST['telefono'])) {
           $errors[] = "Telefono vacío";
        } else if (empty($_POST['region'])) {
           $errors[] = "seleccione una region";
        } else if (empty($_POST['direccion'])) {
           $errors[] = "direccion vacío";

        }      
   
         else if (
			!empty($_POST['id_clinica'])
		){

	$nombre=$_POST["nomb"];
				$dir=$_POST["direccion"];				
                $telefono = $_POST["telefono"];				
				$region=$_POST["region"];
			 
			 $id=$_POST['id_clinica'];
	
             
             
             
        $sql = "SELECT * FROM siec_clinicas WHERE cli_nombre = '" .$nombre. "' and cli_id_clinica!='" .$id. "' ;";
$query_check_user_name = mysqli_query($mysqli,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);     
             
             
             
             
             
             
             
             
             
             
             
             
             
	

		if ($query_check_user == 0 ){
            
  $iden = "SELECT * FROM siec_clinicas WHERE cli_direccion = '" .$dir. "'and cli_id_clinica!='" .$id. "' ;";
$query_check_iden = mysqli_query($mysqli,$iden);
$query_check_iden=mysqli_num_rows($query_check_iden);     
             
            
         		if ($query_check_iden == 0 ){
            
		$sql="UPDATE siec_clinicas SET cli_nombre='".$nombre."',cli_telefono= '".$telefono."',cli_direccion='".$dir."',	cli_region='".$region."' WHERE cli_id_clinica='".$id."'";
		$query_update = mysqli_query($mysqli,$sql);
		
                      
			if ($query_update){
				 
			 
				$messages[] = "El registro ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($mysqli);
            }
			}else{
              $errors []= "El documento Pertenece a otro empleado"; 
             } 
             
             }else{
              $errors []= "La Clave Pertenece a otro empleado"; 
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