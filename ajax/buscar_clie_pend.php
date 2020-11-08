<?php


require '../funcs/conexion.php';
require '../funcs/funcs.php';

session_start();


$rol = $_SESSION['id_rol'];
$idUsuario = $_SESSION['id_usuario'];


?>





<div class="table-responsive" id="tableListar_length">
  <table class="table table-striped b-t b-light" id="tableListar" style="margin: 10px 0 0 0;">
    <thead>
      <tr class="success">

     <th>N°</th>
             <th>Identidad</th>
             <th>Nombre</th>
           
         
              <th>Estado</th>
             <th>Fecha Atencion</th>
   
            <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php








      $sql = "SELECT * FROM tbl_atenciones a inner join tbl_clientes c on a.id_cliente = c.id_cliente 
inner join tbl_usuario u on a.id_usuario= u.id_usuario WHERE LEFT(fecha_visita,10)=CURDATE() order by id_atencion ASC";
      $query = mysqli_query($mysqli, $sql);

          $item=0;
      $count_query   = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM tbl_atenciones");
      $row1 = mysqli_fetch_array($count_query);

      $numrows = $row1['numrows'];


      if ($numrows > 0) {

        while ($row = mysqli_fetch_array($query)) {

      	$item = $item+1;	
        $id=$row['id_atencion'];
        $clave=$row['identidad'];
		$nombre=$row['nom_cliente'];
		 $fecha=$row['fecha_visita'];
		 $fecha= date('d/m/Y', strtotime($fecha));
$status=$row['status'];
                        
			
               $pendiente="PENDIENTE";$label_class='label-warning';
            $atendido="ATENDIDO";$label_class='label-success';
      $ausente="AUSENTE";$label_class='label-danger';
            $finalizado = " ATENCION FINALIZADA";$label_class='label-danger';
      ?>


          <tr>


          <td><?php echo $item; ?></td>
                <td><?php echo $clave;?></td>
                <td><?php echo $nombre;?></td>
 
                  	
                  
                  <?php 
                     
            switch ($status) {
    case 1:
                  ?> <td><span class="label label-warning"><?php echo $pendiente; ?></span> </td> <?php
        break;
    case 2:
                  ?> <td> <span class="label label-info"><?php echo  $atendido; ?></span></td> <?php
        break;
    case 3:
                  ?> <td> <span class="label label-danger"><?php echo  $ausente; ?></span></td> <?php
        break;
                    
      case 4:
                  ?> <td> <span class="label label-success"><?php echo  $finalizado; ?></span></td> <?php
        break;               
                    
}
          ?>
                  
                  
                  
                  
                  <td><?php echo $fecha;?></td>
                  
                  
               
                    
                
            <td>

          <?php  if ($status ==1 || $status == 3){ ?>

         <a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $id;?>','<?php echo $status; ?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
             
         <?php    } ?>

            </td>
          </tr>
        <?php

        }
      } else {

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