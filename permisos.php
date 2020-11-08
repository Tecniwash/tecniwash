<?php


session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';



if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
}


$id_usu = $_SESSION['id_usuario'];
//echo $_SESSION['menus'];

$objeto="pantalla usuario";
		$accion="INGRESO";
		$descripcion="ingreso a pantalla usuario";
		
		$bita=grabarBitacora($id_usu,$objeto,$accion,$descripcion);



?>

<!DOCTYPE html>
<html>

<head>
    <title>HOME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/morris.css" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="css/monthly.css">
 
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="tableexport.min.css">
 
  <script src="js/jquery.min.js"></script>
  <script src="js/FileSaver.min.js"></script>
  <script src="js/tableexport.min.js"></script>
  <!--- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>-->
	     <link href="css/select2.min.css" rel="stylesheet" /> 
      <script src="js/select2.min.js"></script>
    <script src="./dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./dist/sweetalert.css">
    
    
          
      
<script>
      
      
      
      
       
    function seleccionar_todo(){ 
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=0 
}
      
      
      
      
      
      
      
      
      </script>
</head>

<body>
         <?php 
require("./roles_objeto_bd.php"); 
         include("modal/editar_permisos.php");
        include("modal/eliminar_permiso.php");

 ?>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="home.php" class="logo">
                    MENU
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="images/2.png">
                            <span class="username"><?php echo $_SESSION['usuario'] ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">

                            <li><a href="logout.php"><i class="fa fa-key"></i>Salir</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <?php
                        if ($id_usu == 1) {
                            include("menu2.php");
                        }
                        //echo $_SESSION['menus']; 
                        ?>

                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="table-agile-info">
                    <div class="panel panel-default">
                        
                        <form  method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" accept-charset="UTF-8" class="form-conteiner" name = "f1">
                        <div class="panel-heading">
                       PERMISOS ROLES
                            <div class="btn-group pull-right">
                                <button type='submit' class="btn btn-success"  id="id_btn_guardar"  name="btn_guardar"><span class="glyphicon glyphicon-plus"></span> Agregar </button>
                            </div>
                        </div>
                        <div class="row w3-res-tb">

                        <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon">ROL</span>
		   
             <select class="myselect"   style='width:200px' id="combo_roles" name="combo_roles">

    <!--//seleccionamos id rol y nombre del rol de la tabla roles y las metemos en variable $sql .
    luego verificamos la conexion,luego entramos a una codicion si numero de columnas es mayor q 0 -->

    	<?php 

    $sql = "SELECT rol_id_rol, rol_nombre FROM roles";
    $result = $mysqli->query($sql);
    echo "<option selected = 'selected' disabled = 'disabled'> Elija un Rol</option>";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        //codigo generado por php
            echo "<option value='".$row['rol_id_rol']."'>".$row['rol_nombre']."</option>"; 
        }
    } 
    	?>

    </select>                 
                            
                            
                            </div>
		</div>
                <div class="col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon">PANTALLA</span>
		   <select  class="myselect" style='width:200px' id="combo_objeto" name="combo_objeto">

<!--//seleccionamos id rol y nombre del rol de la tabla roles y las metemos en variable $sql .
luego verificamos la conexion,luego entramos a una codicion si numero de columnas es mayor q 0 -->

	<?php 

$sql = "SELECT menu_id, pant_nombre FROM menu where id_padre !=0 order by pant_nombre";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<option selected = 'selected' disabled = 'disabled'> Elija una Pantalla</option>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    //codigo generado por php
        echo "<option value='".$row['menu_id']."'>".$row['pant_nombre']."</option>";
    }
} 
	?>

</select> </div>
		</div>
   
		<div class="input-group">
		   <input type="checkbox" id="ck_insertar" name = 'ck_insertar'style="margin-left:20px">Insertar
            <br>
            <input type="checkbox" id="ck_actualizar" name = 'ck_actualizar' style="margin-left:20px">Actualizar
            <br>
            <input type="checkbox" id="ck_eliminar" name = 'ck_eliminar' style="margin-left:20px">Eliminar
	



                        </div>
                            
                            
                            
                        <div id="resultados"></div><!-- Carga los datos ajax -->
                        <div class='outer_div'></div>

                    </div>
                </div>
            </section>

       
            <script src="js/bootstrap.js"></script>
            <script src="js/jquery.dcjqaccordion.2.7.js"></script>
            <script src="js/scripts.js"></script>
            <script src="js/jquery.slimscroll.js"></script>
            <script src="js/jquery.nicescroll.js"></script>
            <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
            <script src="js/jquery.scrollTo.js"></script>
            <!-- morris JavaScript -->

            <!-- calendar -->
            <script type="text/javascript" src="js/monthly.js"></script>

            <!-- //calendar -->


<!-- Modal -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">¿Seguro que deséa eliminar este Cliente?</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="editar_password" name="editar_password">
                    <div id="mensajeAjax"></div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <input type="hidden" id="clientId" name="clientId">
                            <div class="container">
                                <img width="50%" src="./images/delete.svg">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer center">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger" id="eliminarProducto">Eliminar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</body>

</html>
<script>
    $(document).ready(function() {
        load(1);
    });

    function
    obtener_id(item) {
        let val = item;
        let id = document.getElementById('clientId');
        id.value = val;
        $("#user_id_mod").val(item);
    }


    /*$("#editar_password").submit(function(event) {
        $('#actualizar_datos3').attr("disabled", true);
        var tabla = "tbl_clientes";
		var campo = "id_cliente";
        var  user_id_mod =  $("#user_id_mod").val(item);
        $.ajax({
            type: "POST",
            url: "ajax/eliminar_cliente.php",
            data: 'tabla='+tabla+'&campo='+campo+'&user_id_mod='+user_id_mod,
            beforeSend: function(objeto) {
                $("#resultados_ajax3").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#resultados_ajax3").html(datos);
                $('#actualizar_datos3').attr("disabled", false);
               // load(1);
            }
        });
        event.preventDefault();
    })*/

    function load(page) {

        $("#loader").fadeIn('slow');
        $.ajax({
            url: 'ajax/buscar_permisos.php',
            beforeSend: function(objeto) {
                $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
            },
            success: function(data) {
                $(".outer_div").html(data).fadeIn('slow');
                $('#loader').html('');

            }
        })
    }






$(".myselect").select2();

         
    $('#procesar').on('click', function(){
      
		var desde = $('#fecha_ini').val();
		var hasta = $('#fecha_fin').val();
		var url = 'ajax/busca_clientes_fecha.php';
            
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(data){
   
			$(".outer_div").html(data).fadeIn('slow');
            ExportTable();
            $('#loader').html('');
            
           
		}
	});
	return false;
	});
	
        
       
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