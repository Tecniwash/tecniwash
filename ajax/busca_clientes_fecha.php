<?php

include('../funcs/conexion.php');
include('../funcs/funcs.php');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//if para añadirle condiciones al select

//$cli=$_POST['cli'];
session_start();
 
$rol = $_SESSION['id_rol'];
$idUsuario = $_SESSION['id_usuario'];
if (
			!empty($hasta) &&
			!empty($desde) 
		){

	$con_fecha="and  ate_fecha_visita BETWEEN '$desde' AND '$hasta'";
    $tit_fecha=" de la fecha : $desde  hasta  $hasta";
    
    
    
    
}else{
    $con_fecha="";
    $tit_fecha="";
    
}












?>

   
    <link rel="stylesheet" href="../css/tableexport.min.css">
 
  <script src="../js/jquery.min.js"></script>
  <script src="../js/FileSaver.min.js"></script>
  <script src="../js/tableexport.min.js"></script>







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
            
            <tr>
            <th><b> Reporte de Clientes <?php echo $tit_fecha; ?> </b>
          </th>
            
            </tr>
            
   
      <tr class="success">
            

           
             <th>Identidad</th>
             <th>Nombre</th>
             <th>Telefonos </th>
             <th>Correo</th>
             <th>fecha</th>
      
           
          </tr>
        </thead>
        <tbody>
            <?php
 $sql = "SELECT * FROM tbl_clientes ";          
	//echo $cli;
//echo $sql;
	$query = mysqli_query($mysqli, $sql);
             $item=0; 
if(mysqli_num_rows($query)>0){
	while($row = mysqli_fetch_array($query)){
		$item = $item+1;
		
			
			               $item=$row['id_cliente'];
			               $id=$row['identidad'];
						$apellido=$row['ape_cliente'];
						$nom=$row['nom_cliente'];
				        $cel=$row['celular'];
			            $tel=$row['telefono'];
			           $correo=$row['cor_cliente'];
                  $fecha=$row['fecha_registro'];
                 $fecha= date('d/m/Y', strtotime($fecha));
			           $gender= $row['genero'];
			           $direccion=$row['direccion'];

		
?>
		    <tr>
               <td><?php echo $id ?></td>
                <td><?php echo $nom." ". $apellido;?></td>
                <td><?php echo $cel."||".$tel;?></td>
                 <td><?php echo $correo;?></td>
                  <td><?php echo $fecha;?></td>
    
                
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
  
     