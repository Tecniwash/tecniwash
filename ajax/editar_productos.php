<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';


session_start();



?>

<?php
	
	if (empty($_POST['id'])) {
           $errors[] = "id vacío";
        }else if (empty($_POST['cod'])) {
           $errors[] = "codigo vacío";
         
        }else if (empty($_POST['nom'])) {
           $errors[] = "nombre vacío";
        } else if (empty($_POST['cla'])) {
           $errors[] = "clasificacion vacío";
        } else if (empty($_POST['uni'])) {
           $errors[] = "especifique unidad de medida";
        } else if (empty($_POST['pre'])) {
           $errors[] = "presentacion vacío";
    
        } 
         
   
         else if (
			!empty($_POST['id'])
		){

		$id=$_POST['id'];
		$cod=$_POST["cod"];
		$nom=$_POST["nom"];
		$cla=$_POST["cla"];
		$uni=$_POST["uni"];
		$pre=$_POST["pre"];
			 $nombre=strtoupper($nom);
			 
			$id_emple=$_SESSION["id_usuario"]; 
	
             
   
             
             
             
             
             
             
             
             
             
	
            
                      
        $iden = "SELECT * FROM siec_inventario WHERE inv_nombre_producto = '" .$nom. "'and inv_id_inventario!='" .$id. "' ;";
$query_check_iden = mysqli_query($mysqli,$iden);
$query_check_iden=mysqli_num_rows($query_check_iden);     
             
            
         		if ($query_check_iden == 0 ){
            
		$sql="UPDATE siec_inventario SET inv_nombre_producto='".$nombre."',inv_id_clasificacion= '".$cla."',inv_id_um='".$uni."',inv_presentacion='".$pre."' WHERE inv_id_inventario='".$id."'";
		$query_update = mysqli_query($mysqli,$sql);
		
                      
			if ($query_update){
				 
			 
				$messages[] = "El registro ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($mysqli);
            }
			}else{
              $errors []= "Este nombre de medicamento ya esta registrado"; 
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