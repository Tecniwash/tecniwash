<?php
if (isset($_GET['term'])){

include("../../funcs/conexion.php");
  include("../../funcs/funcs.php");      

$return_arr = array();
/* If connection to database, run sql statement. */
if ($mysqli)
{
	
	$fetch = mysqli_query($mysqli,"SELECT * FROM siec_empleados where emp_clave_empleado like '%" . mysqli_real_escape_string($mysqli,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_cliente=$row['emp_id_empleado'];
        
        
        
	   $edad=getEDAD($id_cliente);
        
        
        
		$row_array['value'] = $row['emp_clave_empleado'];
		$row_array['id_cliente']=$id_cliente;
		$row_array['nombre_cliente']=$row['emp_clave_empleado'];
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