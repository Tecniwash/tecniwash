<?php
require_once 'funcs/funcs.php';

require( 'funcs/conexion.php');


/*
$post = file_get_contents('php://input');
	echo $post;
	*/
 if (!$_POST["identidad"] or !$_POST["nombre"] or !$_POST["apellido"] or !$_POST["correo_electronico"] 
 or !$_POST["celular"] or !$_POST["telefono"] or !$_POST["direccion"] or !$_POST["gender"] ) {

	
	 echo json_encode("Llene todos los campos");
return;



	 };
	 

              
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
			
					
                    $consulta=("INSERT INTO tbl_clientes(nom_cliente,identidad,ape_cliente,cor_cliente,celular,telefono,direccion, genero ) VALUES('$nombre', '$id', '$ape','$correo','$cel','$tel','$dir','$gender')");
					$resultado=mysqli_query($mysqli,$consulta) or die (mysqli_error($mysqli));
            
         
                    // if user has been added successfully
                    if ($resultado) {
						echo json_encode("ok");
                       
                    } else {
						
						echo json_encode("Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.");
                      
				   
					
					
					}

?>
