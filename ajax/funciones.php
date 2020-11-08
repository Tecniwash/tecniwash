<?php 
function get_row($table,$row, $id, $equal){
	global $mysqli;
	
	$query=mysqli_query($mysqli,"select $row from $table where $id='$equal'");
	
	$rw=mysqli_fetch_array($query);
	$value=$rw[$row];
	return $value;
}


function getCualquiera($campo, $tabla, $campoWhere, $valor)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT $campo FROM $tabla WHERE $campoWhere = ? ");
	$stmt->bind_param('i', $valor);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0) {
		$stmt->bind_result($_campo);
		$stmt->fetch();
		return $_campo;
	} else {
		return null;
	}
}


	function getValor($valor)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT cant FROM products WHERE id_producto = ? ");
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
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT cantidad_tmp FROM tmp WHERE id_tmp = ? ");
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
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id_producto FROM tmp WHERE id_tmp = ? ");
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