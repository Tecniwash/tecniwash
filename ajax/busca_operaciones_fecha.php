<?php

include('../funcs/conexion.php');
include('../funcs/funcs.php');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$producto =$_POST['producto'];
$operaciones =$_POST['operaciones'];
$empleado=$_POST['empleado'];
$cli=$_POST['cli'];
echo $cli;
//if para añadirle condiciones al select

session_start();
 
$rol = $_SESSION['id_rol'];
$idUsuario = $_SESSION['id_usuario'];
$clinica= $_SESSION['clinica'];
	
if (
			!empty($hasta) &&
			!empty($desde) 
		){

	$con_fecha="and fecha_reg BETWEEN '$desde' AND '$hasta'";
    $tit_fecha=" de la fecha : $desde  hasta  $hasta";
    
    
    
    
}else{
    $con_fecha="";
    $tit_fecha="";
    
}




if((!empty($operaciones))){
$con_operacion = "and operacion like '%".$operaciones."%'";

$tit_ope=" operacion : $operaciones";
    
    
    
    
}else{
    
    $con_operacion="";
    $tit_emp="";
}










if((!empty($producto))){
	$con_doctor="and  pro_id_inventario = $producto";
    $nom_doctor=getCualquiera('inv_nombre_producto','siec_inventario','inv_id_inventario',$producto);
    $tit_doc="Producto: $nom_doctor";
    
    
}else{
    
    $con_doctor="";
    $tit_doc="";
}





if((!empty($cli))){
	$con_cli="and  pro_id_clinica = $cli";
    $nom_cli=getCualquiera('cli_nombre','siec_clinicas','cli_id_clinica',$cli);
    $tit_cli="Producto: $nom_cli";
    
    
}else{
    
    $con_cli="";
    $tit_cli="";
}















if((!empty($empleado))){
$con_empleado = "and id_empleado=$empleado";
$nombre_emp = getEMP('emp_nombre','emp_id_empleado',$empleado);
$tit_emp=" empleado : $nombre_emp";
    
    
    
    
}else{
    
    $con_empleado="";
    $tit_emp="";
}






			 if ($rol !=1 and $idUsuario!=1){
         $clinica_b="and pro_id_clinica=$clinica ";
         
     }else{
    $clinica_b="";
          
                 
     }

?>

   
    <link rel="stylesheet" href="tableexport.min.css">
 
  <script src="js/jquery.min.js"></script>
  <script src="js/FileSaver.min.js"></script>
  <script src="js/tableexport.min.js"></script>







  <style>
	table ,tr td{
		border:1px solid white
	}
	tbody {
		display:block;
		height:450px;
		overflow:auto;
	}
	thead, tbody tr {
		display:table;
		width:100%;
		table-layout:fixed;/* even columns width , fix width of table too*/
	}
	thead {
		width: calc( 100% - 1em )/* scrollbar is average 1em/16px width, remove it from thead width */
	}
	.btn-toolbar {
		 margin-left: 0px;
	}
  </style>





<div class="dataTables_length" id="tableListar_length">
      <table class="table" id="tableListar">

          
        <thead>
            
            <tr> <th> Reporte de Productos <?php echo $tit_emp; ?> <?php echo $tit_fecha; ?> <?php echo $tit_doc; ?> <?php echo $tit_cli; ?> </th>
            
            
            
            </tr>
            
            
      <tr class="success">
            

        <th>Cod</th>
             <th>Producto</th>
             <th>Cantidad</th>
              <th>Vence</th>
             <th>Empleado</th>
              <th>Operacion</th>
          <th>Clinica</th>
             <th>Justificacion</th>
              <th>Fecha Registro </th>
           
          </tr>
        </thead>
        <tbody>
            <?php

            
            
 $sql = "SELECT pro_id_entrada, inv_codigo, inv_nombre_producto,pro_justificacion, pro_cantidad,pro_vence, emp_nombre,operacion,fecha_reg , pro_id_clinica from siec_inventario , siec_pro_operaciones,siec_empleados where pro_id_inventario = inv_id_inventario AND id_empleado = emp_id_empleado $con_doctor $con_empleado $con_fecha $con_operacion $clinica_b $con_cli order by pro_id_entrada ASC ";          
	//echo $sql;

	$query = mysqli_query($mysqli, $sql);
             $item=0;
if(mysqli_num_rows($query)>0){
	while($row = mysqli_fetch_array($query)){
		$item = $item+1;
		
	
                $id=$row['inv_codigo'];
			    $producto=$row['inv_nombre_producto'];
                 $cantidad=$row['pro_cantidad'];
               $vence=$row['pro_vence'];
						$empleado=$row['emp_nombre'];
         $justificacion=$row['pro_justificacion'];
              $operacion=$row['operacion'];
				    
            $fecha_inicio=$row['fecha_reg'];
			         
                 $fecha_inicio= date('d/m/Y', strtotime($fecha_inicio));
            //$user_id = $_SESSION['user_session'];
            
            $nom_clinica = getCualquiera('cli_nombre','siec_clinicas','cli_id_clinica',$clinica);
?>
		    <tr>
              
            <td><?php echo $item ?></td>
          <td><?php echo $producto;?></td>
                <td><?php echo $cantidad;?></td>
               
                  <td><?php echo $vence;?></td>
                    <td><?php echo $empleado;?></td>
                    <td><?php echo $operacion;?></td>
                 <td> <?php echo $nom_clinica; ?></td>
                    <td><?php echo $justificacion; ?></td>
                  <td><?php echo $fecha_inicio;?></td>
      
            
                
              </tr>
          <?php
            
           }
          }else{ 
          
          ?>
          <tr>
            <td colspan="4">No se encontraron resultados</td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
         <script>
          //  ExportTable();
            function ExportTable(){
			$("table").tableExport({
				headings: true,                    // (Boolean), display table headings (th/td elements) in the <thead>
				footers: true,                     // (Boolean), display table footers (th/td elements) in the <tfoot>
				formats: ["xls", "csv", "txt"],    // (String[]), filetypes for the export
				fileName: "id",                    // (id, String), filename for the downloaded file
				bootstrap: true,                   // (Boolean), style buttons using bootstrap
				position: "well" ,                // (top, bottom), position of the caption element relative to table
				ignoreRows: null,                  // (Number, Number[]), row indices to exclude from the exported file
				ignoreCols: null,                 // (Number, Number[]), column indices to exclude from the exported file
				ignoreCSS: ".tableexport-ignore"   // (selector, selector[]), selector(s) to exclude from the exported file
			});
		}
            
            </script>
      </div>
  
     