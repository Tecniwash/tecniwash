<?php

  $mysqli = new mysqli("testingdb.c2lgpurhnyvd.us-east-1.rds.amazonaws.com", "root", "NiOlUT2X3M1D2maxbCWI", "bd_tw");
if (mysqli_connect_errno()) {
	echo 'Conexion Fallida : ', mysqli_connect_error();
	exit();
}  
/* 
$servername = '127.0.0.1';
$username = "root";
$password = "";
$dbname = "bd_tw";

$paginacion = "mysql:host=$servername;dbname=$dbname;";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}  */

?>
