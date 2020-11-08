<?php
if (isset($_GET['term'])){

include("../../funcs/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($mysqli)
{
	
	$fetch = mysqli_query($mysqli,"SELECT * FROM siec_enfermedad WHERE 	enf_enfermedad  like '%" . mysqli_real_escape_string($mysqli,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_cliente=$row['enf_id_enfermedad'];
		$row_array['value'] = $row['enf_enfermedad'];
		$row_array['id_cliente']=$id_cliente;
	$row_array['nombre_cliente']=$row['enf_enfermedad'];
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($mysqli);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>