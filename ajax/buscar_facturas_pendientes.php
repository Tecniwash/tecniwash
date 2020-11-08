<?php

	
	
	require_once ("../funcs/conexion.php");//Contiene funcion que conecta a la base de datos
	require_once ("../funcs/funcs.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_factura=intval($_GET['id']);
		$del1="delete from facturas where numero_factura='".$numero_factura."'";
    
		$del2="delete from detalle_factura where numero_factura='".$numero_factura."'";
      
		if ($delete1=mysqli_query($mysqli,$del1) and $delete2=mysqli_query($mysqli,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
                 <script> load(1);</script>
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
                 <script> load(1);</script>
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($mysqli,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "facturas, tbl_clientes,tbl_usuario";
		 $sWhere = "";
		 $sWhere.=" WHERE facturas.id_cliente=tbl_clientes.id_cliente and facturas.id_vendedor=tbl_usuario.id_usuario  and facturas.estado_factura=2 ";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (tbl_clientes.nom_cliente like '%$q%' or facturas.numero_factura like '%$q%')";
			
		}
		
		$sWhere.=" order by facturas.id_factura desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
     
		$query = mysqli_query($mysqli, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($mysqli);
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<th>#</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Vendedor</th>
					<th>Estado</th>
					<th class='text-right'>Total</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente=$row['nom_cliente'];
						$telefono_cliente=$row['telefono'];
						$email_cliente=$row['cor_cliente'];
						$nombre_vendedor=$row['nombre_usuario'];
						$estado_factura=$row['estado_factura'];
						$estado_factura!==1;
                        $text_estado="Pendiente";$label_class='label-warning';
						$id_atencion=$row['id_atencion'];
						$total_venta=$row['total_venta'];
                    
                       $ate_est= getCualquiera('status','tbl_atenciones','id_atencion',$id_atencion );
                     $pendiente="PENDIENTE";$label_class='label-warning';
            $atendido="ATENDIDO";$label_class='label-success';
      $ausente="AUSENTE";$label_class='label-danger';
            $finalizado = "LISTA PARA FACTURAR";$label_class='label-danger';
                  
					?>
					<tr>
						<td><?php echo $numero_factura; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><a href="#" data-toggle="tooltip" data-placement="top" title="<i class='glyphicon glyphicon-phone'></i> <?php echo $telefono_cliente;?><br><i class='glyphicon glyphicon-envelope'></i>  <?php echo $email_cliente;?>" ><?php echo $nombre_cliente;?></a></td>
						<td><?php echo $nombre_vendedor; ?></td>
                        
                        
                        
						       
                  <?php 
                     
            switch ($ate_est) {
    case 1:
                  ?> <td><span class="label label-warning"><?php echo $pendiente; ?></span> </td> <?php
        break;
    case 2:
                  ?> <td> <span class="label label-warning"><?php echo  $pendiente; ?></span></td> <?php
        break;
    case 3:
                  ?> <td> <span class="label label-danger"><?php echo  $ausente; ?></span></td> <?php
        break;
                    
      case 4:
                  ?> <td> <span class="label label-success"><?php echo  $finalizado; ?></span></td> <?php
        break;               
                    
}
          ?>
                
                        
                        
                        
                        
						<td class='text-right'><?php echo number_format ($total_venta,2); ?></td>					
					<td class="text-right">
                    
                        
                        <?php if ($ate_est== 4) {?>
                     <a href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-default' title='Editar factura' ><i class="glyphicon glyphicon-edit"></i></a> 
						
					
						<a href="#" class='btn btn-default' title='Borrar factura' onclick="eliminar('<?php echo $numero_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
					
					    <?php
				}
				?>  
           
                        
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>