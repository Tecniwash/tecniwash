<?php
require_once 'funcs/funcs.php';

require( 'funcs/conexion.php');

if (!$_POST["correo"] or !$_POST["int"] or !$_POST["pre"] or !$_POST["maxpass"] ) {
	$mensaje= "Llene todos los campos.";
	
	 echo json_encode("Llene todos los campos");



 	}else{

		$correo = $_POST["correo"];
		$sc= updParametro($correo,2);
		$min= $_POST["minpass"];
		$smin=updParametro($min,5);
		$max= $_POST["maxpass"];
		$smax=updParametro($max,6);
		$pre=$_POST["pre"];
		$spre= updParametro($pre,9);
		$int=$_POST["int"];
		$sint=updParametro($int,9);

		echo json_encode("ok");
		
		}

?>
