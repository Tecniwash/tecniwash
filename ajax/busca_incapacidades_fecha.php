<?php

include('../funcs/conexion.php');
include('../funcs/funcs.php');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$paciente =$_POST['paciente'];
$doctor =$_POST['doctor'];
$cli=$_POST['cli'];
//if para añadirle condiciones al select

session_start();
 
$rol = $_SESSION['id_rol'];
$idUsuario = $_SESSION['id_usuario'];
$clinica= $_SESSION['clinica'];

if (
			!empty($hasta) &&
			!empty($desde) 
		){

	$con_fecha="and inc_fecha_creacion BETWEEN '$desde' AND '$hasta'";
    $tit_fecha=" de la fecha : $desde  hasta  $hasta";
    
    
    
    
}else{
    $con_fecha="";
    $tit_fecha="";
    
}



if((!empty($doctor))){
	$con_doctor="and  inc_id_usuario = $doctor";
    $nom_doctor=getUSUARIO('usu_nombre_com','usu_id_usuario',$doctor);
    $tit_doc="Doctor: $nom_doctor";
    
    
}else{
    
    $con_doctor="";
    $tit_doc="";
}






if((!empty($paciente))){
$con_empleado = "and inc_id_empleado=$paciente";
$nombre_emp = getEMP('emp_nombre','emp_id_empleado',$paciente);
$tit_emp=" paciente : $nombre_emp";
    
    
    
    
}else{
    
    $con_empleado="";
    $tit_emp="";
}


if((!empty($cli))){
	$con_cli="and inc_id_clinica = $clinica";
    $nom_cli=getCualquiera('cli_nombre','siec_clinicas','cli_id_clinica',$cli);
    $tit_cli="clinica : $nom_cli";
    
    
}else{
    
    $con_cli="";
    $tit_cli="";
}







			 if ($rol !=1 and $idUsuario!=1){
         $clinica_b="and inc_id_clinica=$clinica ";
         
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
            
            <tr> &nbsp;&nbsp;&nbsp;   <b>  Reporte de Incapacidades <?php echo $tit_emp; ?> <?php echo $tit_fecha; ?> <?php echo $tit_doc; ?> </b>
            </tr>
            
            
      <tr class="success">
            

          <th>No</th>
             <th>Clave</th>
             <th>Nombre</th>
              <th>Medico</th>
             <th>Diagnostico</th>
              <th>Tipo</th>
              <th>Clinica Externa</th>
              <th>Medico Externo</th>
             <th>Fecha Inicio </th>
              <th>Fecha Fin </th>
              <th>Total</th>
           
          </tr>
        </thead>
        <tbody>
            <?php

            
            
 $sql = "SELECT * FROM siec_incapacidades inner join siec_empleados on emp_id_empleado = inc_id_empleado inner join siec_usuarios on siec_incapacidades.inc_id_usuario= siec_usuarios.usu_id_usuario inner join siec_mot_incapacidad on siec_incapacidades.inc_id_motivo= siec_mot_incapacidad.mot_id_motivo inner join siec_tip_incapacidad on siec_incapacidades.inc_tid_incapacidad= siec_tip_incapacidad.tip_id_incapacidad where inc_dias_incapacidad!= 0  $con_doctor $con_empleado $con_fecha $clinica_b $con_cli order by inc_id_incapacidad ASC ";          
	//echo $sql;

	$query = mysqli_query($mysqli, $sql);
             $item=0;
if(mysqli_num_rows($query)>0){
	while($row = mysqli_fetch_array($query)){
		$item = $item+1;
		
		             		
$id=$row['inc_id_incapacidad'];
			    $clave=$row['emp_clave_empleado'];
                 $nom_emp=$row['emp_nombre'];
               $doctor=$row['usu_nombre_com'];
						$diagnostico=$row['inc_diagnostico'];
         
              $tipo_inca=$row['tip_nombre'];
				        $cli_ext=$row['inc_clinica_externa'];
            $mediex=$row['inc_medico_externo'];
            
                
            $fecha_inicio=$row['inc_fecha_inicio'];
			            $fecha_fin=$row['inc_fecha_inicio'];
                 $fecha_inicio= date('d/m/Y', strtotime($fecha_inicio));
            $fecha_fin=date('d/m/Y', strtotime($fecha_fin));
            $cant=$row['inc_dias_incapacidad'];
            
            
            $fecha =$row['inc_fecha_creacion'];
             $fecha=date('d/m/Y', strtotime($fecha));
            $hoy=date("d/m/Y");
            
           
            
            $id_doctor =$row['inc_id_usuario'];
            //$user_id = $_SESSION['user_session'];
            
            
?>
		    <tr>
              
            <td><?php echo $item ?></td>
              <td><?php echo $clave;?></td>
                <td><?php echo $nom_emp;?></td>
               
                  <td><?php echo $doctor;?></td>
                    <td><?php echo $diagnostico;?></td>
                    <td><?php echo $tipo_inca;?></td>
                  <td><?php echo $cli_ext;?></td>
                  <td><?php echo $mediex;?></td>
                  <td><?php echo $fecha_inicio;?></td>
                  <td><?php echo $fecha_fin;?></td>
                  <td><?php echo $cant;?></td>
            
                
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
  
     