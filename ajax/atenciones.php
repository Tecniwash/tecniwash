
<?php
require '../funcs/conexion.php';
require '../funcs/funcs.php';
//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js

//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css

?>
       <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="../css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../css/estilos.css" rel="stylesheet">

        
  
     
      
        <div class="dataTables_length" id="tableListar_length">
      <table class="table" id="tableListar">
        <thead>
          <tr class="success">
             
             <th>Id</th>
             <th>clave</th>
             <th>nombre </th>
             <th>diagnostico</th>
              <th>doctor</th>
             <th>fecha atencion</th>
            <th> gestionarAcciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
			
			
			

  
			
			 $sql = "SELECT * FROM atenciones inner join empleados on atenciones.ate_clave_empleado= empleados.emp_clave_empleado inner join users on atenciones.ate_id_usuario= users.user_id order by ate_id_atencion ASC";

			$query = mysqli_query($mysqli, $sql);
     
			
			$count_query   = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM atenciones");
		$row1= mysqli_fetch_array($count_query);
			
			$numrows = $row1['numrows'];
			
 
          if ($numrows>0){
			
        while ($row=mysqli_fetch_array($query)){
			
            $id=$row['ate_id_atencion'];
			               $clave=$row['ate_clave_empleado'];
						$nombre=$row['emp_nombre_empleado'];
						$diagnostico=$row['ate_diagnostico'];
            $doctor=$row['user_name'];
				        $fecha=$row['ate_fecha_visita'];
			            
                 $fecha= date('d/m/Y', strtotime($fecha));
			           
          ?>
   
             
              <tr>
              
                <td><?php echo $id ?></td>
                <td><?php echo $clave;?></td>
                <td><?php echo $nombre;?></td>
                 <td><?php echo $diagnostico;?></td>
                  <td><?php echo $doctor;?></td>
                  <td><?php echo $fecha;?></td>
                <td>
                    
                    
                   <a href="#" class='btn btn-danger' title='eliminar cliente'  data-toggle="modal" data-target="#myModal4" onclick='obtener_id("<?php echo $item;?>")' ><i class="glyphicon glyphicon-remove"></i></a>     
                    
                       
                  <a href="#" class='btn btn-primary' title='Editar cliente'  data-toggle="modal" data-target="#myModal2" onclick='obtener_datos("<?php echo $id;?>" , "<?php echo $nom ?>", "<?php echo $apellido ?>", "<?php echo $cel ?>","<?php echo $tel ?>","<?php echo $correo ?>","<?php echo $direccion ?>","<?php echo $membresia ?>")' ><i class="glyphicon glyphicon-edit"></i></a> 
                  <?php } ?>	
                  	
             
             <a href="lista_mas.php?user_id=<?php echo $item;?>" data-toggle="tooltip" title="buscar mascotas"  class='btn btn-warning'><span class="glyphicon glyphicon-list"></span></a>      	
            
						
               
               
             
               
               
                </td>
              </tr>
          <?php
            
           
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
      <script src="js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/locales/bootstrap-datepicker.es.js"></script>
	

        <script src="js/validator.js"></script>

    <script src="js/global.js"></script>
     