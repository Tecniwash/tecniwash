<?php
/* 
  $mysqli = new mysqli("testingdb.c2lgpurhnyvd.us-east-1.rds.amazonaws.com", "root", "NiOlUT2X3M1D2maxbCWI", "bd_tw");
if (mysqli_connect_errno()) {
	echo 'Conexion Fallida : ', mysqli_connect_error();
	exit();
}  
 */

    $con=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_error()." : ". mysqli_connect_error());
    }
?>
