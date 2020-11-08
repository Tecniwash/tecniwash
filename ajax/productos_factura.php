<?php

	
	//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	//Contiene las variables de configuracion para conectar a la base de datos
	require ("../funcs/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
       $q = mysqli_real_escape_string($mysqli,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('codigo_producto', 'nombre_producto');//Columnas de busqueda
		 $sTable = "products";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE  (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
 //include pagination file
		//pagination variables
		//$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		//$per_page = 5; //how much records you want to show
		//$adjacents  = 4; //gap between pages after number of adjacents
		//$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		/*$count_query   = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data*/
        $count_query   = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM products WHERE cant >0 ");
		$sql="SELECT * FROM  products WHERE cant >0";
		$query = mysqli_query($mysqli, $sql);
        $row= mysqli_fetch_array($count_query);
		//loop through fetched data
        $numrows = $row['numrows'];
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="warning">
					<th>Código</th>
					<th>Producto</th>
					<th><span>Stock</span></th>
					<th><span class="pull-right">Cant.</span></th>
					<th><span class="pull-right">Precio</span></th>
					<th class='text-center' style="width: 36px;">Agregar</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$codigo_producto=$row['codigo_producto'];
					$nombre_producto=$row['nombre_producto'];
					$cantidad=$row['cant'];
					$precio_venta=$row["precio_producto"];
					$precio_venta=number_format($precio_venta,2,'.','');
					?>
					<tr>
						<td><?php echo $codigo_producto; ?></td>
						<td><?php echo $nombre_producto; ?></td>
						<td><?php echo $cantidad; ?></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input type="number" class="form-control" style="text-align:right" min="1" max="<?php echo $cantidad; ?>" id="cantidad_<?php echo $id_producto; ?>"  value="1" >
						</div></td>
						<td class='col-xs-2'><div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo $precio_venta;?>" >
						</div></td>
						<td class='text-center'><a class='btn btn-info'href="#"  onclick="agregar('<?php echo $id_producto ?>');load(1);"><i class="glyphicon glyphicon-plus"></i></a></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=5><span class="pull-right">
					<?php
            include 'pagination.php';
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //how much records you want to show
            $total_pages = ceil($numrows/$per_page);
		$adjacents  = 4;
            		$reload = './index.php';
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>