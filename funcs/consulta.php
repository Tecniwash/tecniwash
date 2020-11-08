<?php 

require 'conexion.php';
require 'funcs.php';

session_start();

if (empty($_POST['masco'])){
				echo json_encode("seleccione una vehiculo");
        
		} elseif (empty($_POST['detalle'])){
		 	echo json_encode( "Destalle de atencion esta vacio.");
        } elseif (empty($_POST['id_clie'])) {
            echo json_encode( "cliente vacio");	
        

  
   }
			
elseif (

			 !empty($_POST['mod_id'])


        ) {


    $id_cliente=$_POST['id_clie'];

    $auto=$_POST['masco'];
    $obs=$_POST['detalle'];
    $ate=$_POST['mod_id'];
    $fin=$_POST['fin'];
    $bol=getCualquiera('numero_factura','facturas','id_atencion',$ate);
    $num_fact=getNum();
        //echo $num_fact;
    if ( $num_fact == null ) {
        $num_fact=1;
    }
      // echo $num_fact;

    if ($bol== null){
  //  $num_fact=getNum();

    $condiciones=2;
    $idUsuario = $_SESSION['id_usuario'];
    $date=date("Y-m-d H:i:s");
    $insertar_fact=mysqli_query($mysqli,"INSERT INTO facturas ( numero_factura, id_cliente, id_vendedor, condiciones, total_venta, estado_factura, id_atencion,fecha_factura) VALUES ('$num_fact','$id_cliente','$idUsuario','$condiciones',(SELECT sum(precio_tmp) as Total FROM tmp WHERE num=$ate),'2',$ate,'$date')");
    $detalle=mysqli_query($mysqli,"INSERT INTO detalle_factura(numero_factura, id_producto, cantidad, precio_venta) select $num_fact , id_producto, cantidad_tmp,precio_tmp from tmp where num=$ate");

    }else {

        $num_fact=$bol;

      $delinsertar_fact=mysqli_query($mysqli,"delete from detalle_factura where numero_factura='".$bol."'");
      $detalle=mysqli_query($mysqli,"INSERT INTO detalle_factura(numero_factura, id_producto, cantidad, precio_venta) select $bol , id_producto, cantidad_tmp,precio_tmp from tmp where num=$ate");

		$query_update = mysqli_query($mysqli,$delinsertar_fact);

    }


    	$sql="UPDATE tbl_atenciones SET id_auto='".$auto."',observacion='".$obs."', status= '".$fin."'  WHERE id_atencion=".$ate."";

		$query_update = mysqli_query($mysqli,$sql);

			if ($query_update){

		echo json_encode("ok");
            }else{
		echo json_encode("error");
}
    
    }


?>