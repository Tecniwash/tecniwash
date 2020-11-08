<?php
require_once 'funcs/funcs.php';

require( 'funcs/conexion.php');


/*
$post = file_get_contents('php://input');
	echo $post;
	*/
 if (!$_POST["identidad"] or !$_POST["nombre"] or !$_POST["apellido"] or !$_POST["correo_electronico"] 
 or !$_POST["celular"] or !$_POST["telefono"] or !$_POST["direccion"] or !$_POST["gender"] or !$_POST["id"] ) {

	
	 echo json_encode("Llene todos los campos");
return;



	 };
	 

               $id_clie = $_POST["id"];
				$id=$_POST["identidad"];
				$nombre=$_POST["nombre"];				
                $ape = $_POST["apellido"];				
				$correo=$_POST["correo_electronico"];
    			$cel= $_POST["celular"];
    			$tel= $_POST["telefono"];
                $gender= $_POST["gender"];
               $dir=$_POST["direccion"];
            

            
                // check if user or email address already exists
			
			
			
					// write new user's data into database
			
					
					$sql="UPDATE tbl_clientes SET identidad='".$id."',nom_cliente='".$nombre."',direccion='".$dir."', ape_cliente='".$ape."', celular='".$cel."', cor_cliente='".$correo."', telefono='".$tel."', genero = '".$gender."' WHERE id_cliente='".$id_clie."'";
					$resultado = mysqli_query($mysqli,$sql);
					
                    // if user has been added successfully
                    if ($resultado) {
						echo json_encode("ok");
                       
                    } else {
						
						echo json_encode("Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.");
                      
				   
					
					
					}

?>
