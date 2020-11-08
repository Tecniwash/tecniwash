<?php

require '../funcs/conexion.php';
require '../funcs/funcs.php';
$hasta = $_POST['hasta'];






?>
   
<div class="table-responsive" id="tableListar_length">
     <table class="table table-striped b-t b-light" id="tableListar">
        <thead>
          <tr class="success">
        
            <th>Servicio</th>
            <th>cantidad</th>
            <th>precio</th>
            
          <th>eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
				
			 $sql = "select * from products, tmp where products.id_producto=tmp.id_producto  and num='$hasta'";
            //num='$hasta'";
            

			$query = mysqli_query($mysqli, $sql);
			$count_query   = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM products ");
		$row1= mysqli_fetch_array($count_query);
			
			$numrows = $row1['numrows'];
			
          if ($numrows>0){
			
        while ($row=mysqli_fetch_array($query)){
			
			             $id_tmp=$row['id_tmp'];
			            $parametro=$row['nombre_producto'];
						$valor=$row['cantidad_tmp'];
				       	$precio=$row['precio_tmp'];
          ?>
                      
              <tr>
         
         
                <td><?php echo $parametro; ?></td>
                <td><?php echo $valor;?></td>
                       <td><?php echo $precio;?></td>
                
                <td>      	 <a href="#" class='btn btn-default' title='Eliminar Parametro'  data-toggle="modal" data-target="#myModal4" onclick='capturar("<?php echo $id_tmp;?>" )' ><i class="glyphicon glyphicon-remove"></i></a> </td>
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
     
      </div>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/locales/bootstrap-datepicker.es.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script src="js/global.js"></script>