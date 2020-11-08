<?php
require_once 'funcs/funcs.php';

require( 'funcs/conexion.php');

if (!$_POST["pass1"] or !$_POST["txt_nc"] or !$_POST["correo"] or !$_POST["txt_us"] or !$_POST["combo_estado"] ) {
	$mensaje= "Llene todos los campos.";
	
	 echo json_encode("Llene todos los campos");



 	}else{
	
	
	
	
	
		$us= $_POST["txt_us"];
				$us= strtoupper($us);
     
    $pass1= $_POST["pass1"];
	$pass2=$_POST["pass2"];
	$correo= $_POST["correo"];
	$lo=("select correo_electronico from tbl_usuario where correo_electronico='$correo'");
				$ss=mysqli_query($mysqli,$lo) or die (mysqli_error($mysqli));
				$fb=mysqli_fetch_row($ss);
	
	
				$valid_cor=formato_correo($correo);
				if ($valid_cor==false){
				
					echo json_encode("Formato de correo invalido.");
					return;
				
				}



			if (!minMaxPass($pass1)){

			
				$min= getCualquiera('descripcion', 'tbl_parametros','id_parametro',5);
	
				$max= getCualquiera('descripcion', 'tbl_parametros','id_parametro',6);
							echo json_encode  ("No cumple el largo estandar que es minimo $min y  maximo $max  !.");
							return;

			}
				
		$la=("select usuario from tbl_usuario where usuario='$us'");
				$sa=mysqli_query($mysqli,$la) or die (mysqli_error($mysqli));
				$fa=mysqli_fetch_row($sa);
	

 			if ($fb) {
				$mensaje= "Este correo ya existe ";
				echo json_encode  ( "Este correo ya existe ");
		 		
			}elseif($pass1!=$pass2){
				echo json_encode  ("las contraseñas no coinciden ");
				
			}elseif($fa){
				echo json_encode  ("ya existe este usuario ");
				
			}	else{

				$nom=$_POST["txt_nc"];
		
                $nom= strtoupper($nom);
				$us= $_POST["txt_us"];
				$us= strtoupper($us);


				
				//$estado= $_POST["combo_estado"];
				$estado="NUEVO";
				//$rol= $_POST["rol"];
				//echo $rol;
				//$f1= $_POST["fecha1"];
		
		
				$pass_hash = hashPassword($pass1);
				$co=("select * from tbl_usuario where '$us'=usuario");
				$res=mysqli_query($mysqli,$co) or die (mysqli_error($mysqli));
				$fss=mysqli_fetch_row($res);
				if (preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,16}$/', $pass1))
				if (!$fss) {
					$consulta=("insert into tbl_usuario (nombre_usuario,usuario,contrasena,correo_electronico,estado_usuario,activacion,fecha_cambio_contrasena) values('$nom', '$us','$pass_hash','$correo','$estado',1,NOW())");


				//S	echo $consulta;
					$resultado=mysqli_query($mysqli,$consulta) or die (mysqli_error($mysqli));
					grabarHisPas($us,$pass_hash );
					grabarBitacora('0',"Autoregistro","INSERT", $consulta);

					$asunto="Se creo usuario $us en TECNIWASH en autoregistro.";
$cuerpo = "Se a registrado al sistema $nom sistema de TECNIWASH con el user $us  .";
				
					$admin_usuarios= getCualquiera('descripcion', 'tbl_parametros','id_parametro',2);
	
					enviarEmail($admin_usuarios, $nom, $asunto, $cuerpo);
                    echo json_encode("ok");
                    
              
				}else{
					echo json_encode  ("El Usuario ya existe.");
					
                    }else{

						echo json_encode  ("Su Contraseña debe Incluir Una Mayúscula, Minuscula, Números y Caracteres Especiales !.");
          
				}
				//mysqli_close($mysqli);
			}
		}

?>
