<?php
if (isset($_GET['term'])){

include("../../funcs/conexion.php");
  include("../../funcs/funcs.php");      

$return_arr = array();

if ($mysqli)
{
	
	$fetch = mysqli_query($mysqli,"SELECT * FROM siec_existencias_detalle, siec_inventario WHERE exi_id_inventario = inv_id_inventario and inv_nombre_producto  like '%" . mysqli_real_escape_string($mysqli,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_inventario=$row['exi_id_inventario'];
        
        
        
	 
        
        $row_array['value'] = $row['inv_codigo']." | ".$row['inv_nombre_producto'];

		$row_array['id_cliente']=$id_inventario;
		$row_array['nombre_cliente']=$row['exi_cantidad'];
		$row_array['telefono_cliente']=$row['emp_nombre'];
$row_array['email_cliente']=$row['emp_id_uniadmin'];
        $row_array['direccion']=$row['emp_direccion'];
    $row_array['celular']=$row['emp_telefono'];
        $row_array['civil']=$row['emp_estado_civil'];
      $fecha =$row['emp_fecha_nacimiento'];
       
     $row_array['sexo']=$row['emp_sexo'];
    $row_array['fecha']=$edad;
        
        
        
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($mysqli);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>