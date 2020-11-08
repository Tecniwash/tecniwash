<?php
if (isset($_GET['term'])){
require '../funcs/conexion.php';
require '../funcs/funcs.php';

$return_arr = array();
/* If connection to database, run sql statement. */
if ($mysqli)
{
	
	$fetch = mysqli_query($mysqli,"select emp_id_empleado, emp_clave_empleado , emp_nombre , emp_id_uniadmin FROM siec_empleados where emp_clave_empleado  like '%" . mysqli_real_escape_string($mysqli,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_cliente=$row['emp_id_empleado'];
		$row_array['value'] = $row['emp_clave_empleado'];
		$row_array['emp_id_empleado']=$id_cliente;
        $row_array['emp_nombre']=$row['emp_nombre'];
		$row_array['emp_id_uniadmin']=$row['emp_id_uniadmin'];
		
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($mysqli);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>