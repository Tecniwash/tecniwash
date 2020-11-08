<?php
require '../funcs/conexion.php';
require '../funcs/funcs.php';
//$session_id= generatetoken();




session_start();
$session_id= session_id();

//$session_id='jr4a3m2dt3hbkhraph6uv42ath';


if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['atencion'])){$atencion=$_POST['atencion'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}

	
	







if (!empty($id) and !empty($cantidad) )
{
    
    $atencion=$_POST['atencion'];
    $_SESSION['atencion'] = $atencion;
    $id_receta= getMaxreceta();
    
   
    
//$insert_tmp=mysqli_query($mysqli, "INSERT INTO tmp (id_producto,cantidad_tmp,sesion) VALUES ('$id','$cantidad','$session_id')");

    $insert_tmp=mysqli_query($mysqli, "INSERT INTO siec_medicamentos_entregados (ent_id_inventario,ent_id_atencion,ent_cantidad,session_id) VALUES('$id','$atencion','$cantidad',$session_id')");
    
    
    
    
    
    
    
    $cantpro=getCANTI($id);
    $stock=$cantpro-$cantidad;
   
    $update=mysqli_query($mysqli, "UPDATE siec_existencias_detalle SET exi_cantidad='".$stock."' WHERE	exi_id_inventario ='".$id."'");
    

    
    
    
    
    
    
    
}








//<!-------------------------de aqui arriba esta bueno-------------------------->



if (isset($_GET['id']))//codigo elimina un elemento del array
{
    
    
    
$id_tmp=intval($_GET['id']);
    $id_pro=getIDEXI('ent_id_inventario','ent_id_med_entregado',$id_tmp);
     $canti=getIDEXI('ent_cantidad','ent_id_med_entregado',$id_tmp);
    $cantprod=getCANTI($id_pro);
    $stock=$cantprod+$canti;
   
   $update=mysqli_query($mysqli, "UPDATE siec_existencias_detalle SET exi_cantidad='".$stock."' WHERE	exi_id_inventario ='".$id_pro."'");
    
    
$delete=mysqli_query($mysqli, "DELETE FROM siec_medicamentos_entregados WHERE 	ent_id_med_entregado='".$id_tmp."'");
    
    
    
    
    
    
    
    
    
}

?>
<table class="table">
<tr class="warning">
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>

	<th></th>
</tr>
<?php
    
    
    
    $atencion = $_SESSION['atencion'];
	 echo "<script>alert($atencion);</script>";
   // $atencion=$_POST['atencion'];
    
    
	$sumador_total=0;
	$sql=mysqli_query($mysqli, "select * from siec_inventario, siec_medicamentos_entregados where siec_inventario.inv_id_inventario= siec_medicamentos_entregados.ent_id_inventario and ent_id_atencion ='".$atencion."'");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row['ent_id_med_entregado'];
	$codigo_producto=$row['inv_codigo'];
	$cantidad=$row['ent_cantidad'];
	$nombre_producto=$row['inv_nombre_producto'];
	
	
	//$precio_venta=$row['precio_tmp'];
	
	
	

	
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			
		
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}

?>




</table>
