<?php 
function get_row($table,$row, $id, $equal){
	global $con;
    
	$query=mysqli_query($con,"select $row from $table where $id='$equal'");
	$rw=mysqli_fetch_array($query);
	$value=$rw[$row];
	return $value;
}





	function getValor($valor)
	{
		global $con;
		$test= "SELECT cant FROM products WHERE id_producto $valor";
    echo $test;
		$stmt = $con->prepare("SELECT cant FROM products WHERE id_producto = ? ");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}






	function getTemp($valor)
	{
		global $con;
		$test= "SELECT cantidad_tmp FROM tmp WHERE id_tmp $valor ";
    echo $test;
		$stmt = $con->prepare("SELECT cantidad_tmp FROM tmp WHERE id_tmp = ? ");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}

function getpro($valor)
	{
		global $con;
		$test= "SELECT id_producto FROM tmp WHERE id_tmp $valor ";
    echo $test;
		$stmt = $con->prepare("SELECT id_producto FROM tmp WHERE id_tmp = ? ");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}
?>


?>