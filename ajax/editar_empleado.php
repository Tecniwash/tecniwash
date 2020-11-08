<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>

<?php
	
	if (empty($_POST['cla'])) {
           $errors[] = "Clave vacío";
        }else if (empty($_POST['doc'])) {
           $errors[] = "Documento vacío";
         
        }else if (empty($_POST['nom'])) {
           $errors[] = "nombre vacío";
        } else if (empty($_POST['tel'])) {
           $errors[] = "Telefono vacío";
        } else if (empty($_POST['sex'])) {
           $errors[] = "sexo vacío";
        } else if (empty($_POST['dir'])) {
           $errors[] = "direccion vacío";
        } else if (empty($_POST['fec'])) {
           $errors[] = "fecha nacimiento vacío";
        } else if (empty($_POST['uni'])) {
           $errors[] = "unidad vacío";
        }  else if (empty($_POST['civ'])) {
           $errors[] = "Especifique su estado civil";
        } 
         
   
         else if (
			!empty($_POST['id_empleado'])
		){

		$id=$_POST['id_empleado'];
		$nombre=$_POST["nom"];
		$clave=$_POST["cla"];
		$sex = $_POST["sex"];
		$telefono=$_POST["tel"];
		$nac=$_POST["fec"];
		$direccion=$_POST["dir"];
		$uni=$_POST["uni"];
		$civil=$_POST["civ"];
        $tip_doc=$_POST["iden"];
			 $doc=$_POST['doc'];
			 $emp_status=1;
			 $nombre=strtoupper($nombre);
			 $region=$_POST["region"];
             $telcasa=$_POST["tel_casa"];
			 $estado=$_POST['esta'];
	$uni=strtoupper($uni);
             
             $region=$_POST['region'];
             
        $sql = "SELECT * FROM siec_empleados WHERE emp_clave_empleado = '" .$clave. "' and emp_id_empleado!='" .$id. "' ;";
$query_check_user_name = mysqli_query($mysqli,$sql);
$query_check_user=mysqli_num_rows($query_check_user_name);     
             
             
             
             
             
             
             
             
             
             
             
             
             
	

		if ($query_check_user == 0 ){
            
            
                      
        $iden = "SELECT * FROM siec_empleados WHERE emp_documento = '" .$doc. "'and emp_id_empleado!='" .$id. "' ;";
$query_check_iden = mysqli_query($mysqli,$iden);
$query_check_iden=mysqli_num_rows($query_check_iden);     
             
            
         		if ($query_check_iden == 0 ){
            
		$sql="UPDATE siec_empleados SET emp_documento='".$doc."',emp_id_uniadmin= '".$uni."',emp_nombre='".$nombre."',	emp_direccion='".$direccion."', emp_fecha_nacimiento='".$nac."', emp_sexo='".$sex."', emp_tip_documento='".$tip_doc."',emp_telefono='".$telefono."', emp_estado_civil= '".$civil."',emp_tel_casa='".$telcasa."',emp_id_region='".$region."',
        	emp_status_cla='".$estado."' WHERE emp_id_empleado='".$id."'";
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