
<?php

session_start();
require '../funcs/conexion.php';
require '../funcs/funcs.php';

if(($_SESSION['id_usuario'])){
 $idUsuario = $_SESSION['id_usuario'];
    $rol = $_SESSION['id_rol'];
  
//	$eliminar=getPer('permiso_eliminacion',$rol,'3');
	//$actualizar=getPer('permiso_actualizacion',$rol,'3');

	
	
}else{
	header ("Location: index.php");
}


?>
  <div class="table-responsive" id="tableListar_length">
  <table class="table table-striped b-t b-light" id="tableListar" style="margin: 10px 0 0 0;">
    <thead>
      <tr class="success">


             
             <th>Identidad</th>
             <th>Nombre</th>
             <th>Telefonos </th>
             <th>Correo</th>
             <th>fecha</th>
            <th> Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
			
			 $sql = "SELECT * FROM tbl_clientes order by id_cliente ASC";
     
			$query = mysqli_query($mysqli, $sql);
     
			
			$count_query   = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM tbl_clientes  ");
		$row1= mysqli_fetch_array($count_query);
			
			$numrows = $row1['numrows'];
			
 
          if ($numrows>0){
			
        while ($row=mysqli_fetch_array($query)){
			
			
			
			               $item=$row['id_cliente'];
			               $id=$row['identidad'];
						$apellido=$row['ape_cliente'];
						$nom=$row['nom_cliente'];
				        $cel=$row['celular'];
			            $tel=$row['telefono'];
			           $correo=$row['cor_cliente'];
                  $fecha=$row['fecha_registro'];
                 $fecha= date('d/m/Y', strtotime($fecha));
			          
			           $direccion=$row['direccion'];
          ?>
   
             
              <tr>
              
                <td><?php echo $id ?></td>
                <td><?php echo $nom." ". $apellido;?></td>
                <td><?php echo $cel."||".$tel;?></td>
                 <td><?php echo $correo;?></td>
                  <td><?php echo $fecha;?></td>
                <td>
                    
                 
              <a href="edi_clie.php?us=<?php echo $item?> " class='btn btn-default' ui-toggle-class=""><i class="fa fa-pencil text-success text-dark"></i></a>

<a href="#" class='btn btn-default' title='Eliminar usuario'  data-toggle="modal" data-target="#myModal4" onclick='obtener_id("<?php echo $item;?>")' ><i class="glyphicon glyphicon-remove"></i></a>

               
             
               
               
                </td>
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