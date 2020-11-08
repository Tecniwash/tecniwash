<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';



?>


<?php




if (empty($_POST['clave'])) {
           $errors[] = " clave vacia ";  
        
		} else if ($_POST['documento']==""){
			$errors[] = "documento vacío";
        } else if (empty($_POST['nombre'])){
			$errors[] = "Nombre del empleado vacío";
		} else if (empty($_POST['tipo'])){
			$errors[] = "tipo de documento no seleccionado";
        } else if (empty($_POST['sexo'])){
			$errors[] = "tipo de sexo no seleccionado";
		}  else if (empty($_POST['fecha'])){
			$errors[] = "fecha de nacimiento vacia";
		} else if (empty($_POST['civil'])){
			$errors[] = "estado civil no seleccioado";		
		} else if (empty($_POST['uni'])){
			$errors[] = "unidad admon no seleccionada";
        } else if (empty($_POST['direccion'])){
			$errors[] = "direccion vacia";  
    
   } else if (empty($_POST['direccion'])){
			$errors[] = "direccion vacia";  
    

        
        } else if (
			!empty($_POST['clave']) &&
			!empty($_POST['nombre']) 
		){
	
	
				// escaping, additionally removing everything that could be (html/javascript-) code
             // $temporal=$_POST["temporal"];
				$clave=$_POST["clave"];
                $documento=$_POST["documento"];
				$nombre=$_POST["nombre"];				
                $tipo = $_POST["tipo"];				
				$sexo=$_POST["sexo"];
    			$fecha= $_POST["fecha"];
    			$civil= $_POST["civil"];
               $unidad=$_POST["uni"];
               $dir=$_POST["direccion"];
               $tel=$_POST["telefono"];
               $tel_casa=$_POST['tel_casa'];
               $region=$_POST['region'];
           
                        $nombre=strtoupper($nombre);
    $unidad=strtoupper($unidad);
    
            

    

    
    
    
    
    //if ($temporal== "" or $temporal!= "1"){
       if (!empty($_POST['temporal']) ){
           
        $temporal="1";
        
        
    }else{
           $temporal="0";
           
           
       }
    
    
    
    
					
                if ($region==1) {
					
                    $consulta=("INSERT INTO siec_empleados (emp_id_region
                    ,emp_clave_empleado
                    ,emp_documento
                    ,emp_tip_documento,
                    emp_nombre,
                    emp_fecha_nacimiento,
                    emp_sexo,
                    emp_id_uniadmin,
                    emp_telefono,
                    emp_direccion,
                    emp_estado_civil,
                    emp_status_cla,
                    emp_tel_casa) 
                    VALUES('$region','$clave', '$documento', '$tipo','$nombre','$fecha','$sexo','$unidad','$tel','$dir','$civil','$temporal','$tel_casa')");
					$resultado=mysqli_query($mysqli,$consulta) or die (mysqli_error($mysqli));
            
         
                    // if user has been added successfully
                if ($resultado) {                        
                   
                        $messages[] = "Empleado fue creado con éxito.";
                }
                    }else{
                       $errors[] = "Error al registrar empleado"; 
                       
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
