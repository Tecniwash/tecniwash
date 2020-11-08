<?php
require '../funcs/conexion.php';
require '../funcs/funcs.php';
//$session_id= generatetoken();




session_start();
$session_id= session_id();
$clinica= $_SESSION['clinica'];
	$user_id = $_SESSION['id_usuario'];
//$session_id='jr4a3m2dt3hbkhraph6uv42ath';


if (isset($_POST['id'])){$id=$_POST['id'];}

if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}

	if (isset($_POST['vence'])){$vence=$_POST['vence'];}
	







if (!empty($id) and !empty($cantidad) )
{
    
    
     $enc_exis=getMaxexis();
    
    if ($enc_exis==""){
        
        $enc_exis=1;
        
    }
    
    
    
    $_SESSION['enc_exis'] = $enc_exis;
    
    
    
    
    
    
    
$insert_tmp=mysqli_query($mysqli, "INSERT INTO tmp (id_producto,cantidad_tmp,sesion,fecha_vence,operacion,id_empleado,id_clinica) VALUES ('$id','$cantidad','$enc_exis','$vence','entrada','$user_id',$clinica)");


    
    
    $existe_pro= getExisproducto($id);
    
    if ($existe_pro ==1){
        
      $cantpro=getCANTI($id);
    $stock=$cantpro+$cantidad;
         $update=mysqli_query($mysqli, "UPDATE siec_existencias_detalle SET exi_cantidad='".$stock."' WHERE	exi_id_inventario ='".$id."'");
        
        
        
        
        
    } else{
        
        
        $insert_tmp=mysqli_query($mysqli, "INSERT INTO siec_existencias_detalle (exi_id_inventario,exi_cantidad,exi_id_enca_exist, exi_fecha_vence) VALUES('$id','$cantidad','$enc_exis','$vence')");
        
        
        
        
        
    }
    
    
    
    
    
}








//<!-------------------------de aqui arriba esta bueno-------------------------->



if (isset($_GET['id']))//codigo elimina un elemento del array
{
    
    
    
$id_tmp=intval($_GET['id']);
   /* $id_pro=getIDEXI('ent_id_inventario','ent_id_med_entregado',$id_tmp);
     $canti=getIDEXI('ent_cantidad','ent_id_med_entregado',$id_tmp);
    $cantprod=getCANTI($id_pro);
    $stock=$cantprod+$canti;
   
   $update=mysqli_query($mysqli, "UPDATE siec_existencias_detalle SET exi_cantidad='".$stock."' WHERE	exi_id_inventario ='".$id_pro."'");
    */
    
$delete=mysqli_query($mysqli, "DELETE FROM tmp WHERE id_tmp='".$id_tmp."'");
    
    
    
    
    
    
    
    
    
}

?>
<table class="table">
<tr class="warning">
	<th class='text-center'>CODIGO</th>
    	<th>NOMBRE</th>
    <th>FECHA</th>
	<th class='text-center'>CANT.</th>


	<th></th>
</tr>
<?php
    
    
    
    $enc_exis = $_SESSION['enc_exis'];
	
   // $atencion=$_POST['atencion'];
    
    
	$sumador_total=0;
	$sql=mysqli_query($mysqli, "select * from siec_inventario, tmp where siec_inventario.inv_id_inventario= tmp.id_producto and sesion ='".$enc_exis."'");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row['id_tmp'];
	$codigo_producto=$row['inv_codigo'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['inv_nombre_producto'];
	$fecha_vence=$row['fecha_vence'];
	
	//$precio_venta=$row['precio_tmp'];
	
	
	

	
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
            	<td><?php echo $nombre_producto;?></td>
            <td><?php echo $fecha_vence;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
		
			
		
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}

?>




</table>
