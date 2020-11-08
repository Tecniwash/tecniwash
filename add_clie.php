<?php


session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if(!isset($_SESSION['id_usuario'])){
    header ("Location: index.php");
}
$id_usu= $_SESSION['id_usuario'];

//echo $_SESSION['id_usuario'];
//echo $_SESSION['menus'];
?>

<!DOCTYPE html>
<head>
<title>HOME</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="css/monthly.css">
<link rel="stylesheet" href="css/toastr.min.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>

<!-- <link rel="stylesheet  prefetch" href="css/bootstrap2.min" > -->
<!--<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>-->
	
<link rel="stylesheet  prefetch" href="css/bootstrap.min.css" >
<link rel="stylesheet  prefetch" href="css/bootstrap-theme32.min.css" >
<link rel="stylesheet  prefetch" href="css/bootstrapValidator32.min.css" >
  <!--   <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>
	<link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css'> -->


</head>
<body>
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
                
                <li><a href="logout.php"><i class="fa fa-key"></i> Salir</a></li>
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
if ($id_usu==1){
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
		
</section>
<div class="form-w3layouts">
            <!-- page start-->
            
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Agregar cliente
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div class="form">
                            <form class="cmxform form-horizontal " method="post" id="loginform"  action="" novalidate="novalidate">
                            <div class="agileinfo-row">
		  
		       <div class="form-group">
			   <label for="identidad" class="col-sm-3 control-label">Identidad </label>
				<div class="col-sm-8">
			  	 <div class="input-group">
			  	  <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
				  <input  type="tel" class="form-control" id="identidad" name="identidad" placeholder="22345678" pattern="^[9
				  |0|1|2]\d{12}$"  title="min 13 numeros solo"onPaste="return false;"  maxlength="15" autocomplete="off" >
				</div> 
			  </div>
			  </div>
		  
		  
			  <div class="form-group">
			   <label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
			  	 <div class="input-group">
			  	  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				  <input title="nombre" type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" style="text-transform: uppercase;" onkeypress="return soloLetras(event)" maxlength="70" onPaste="return false;" autocomplete="off" required>
				</div>
			  </div>
			  </div>

			  <script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>	

			  
			  
			  

			  <div class="form-group">
			   <label for="apellido" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
			  	 <div class="input-group">
			  	  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				  <input  type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos" pattern="[a-zA-Z0-9]{2,64}" title="Usuario" style="text-transform: uppercase;" onkeypress="return soloLetras(event)"  onPaste="return false;"  maxlength="15" autocomplete="off">
				</div> 
			  </div>
			  </div>
			  		  <script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>	
	 
	   <div class="form-group">
				<label for="contrasena" class="col-sm-3 control-label">Genero</label>
				 <div class="col-sm-8">
		  		  <div class="input-group">
		  		  
		  		  
		  		   <input type="radio" name="gender" id="gender" value="M" checked> Male
  <input type="radio" name="gender" id="gender" value="F"> Female<br>
 
				</div>
			  </div>
			</div> 
		 
			  <div class="form-group">
			   <label for="celular" class="col-sm-3 control-label">Celular</label>
				<div class="col-sm-8">
			  	 <div class="input-group">
			  	  <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
				  <input  type="tel" class="form-control" id="celular" name="celular" placeholder="99003423" pattern="^[9|8|3]\d{7}$"  title="min 8 numeros solo" style="text-transform: uppercase;"  onPaste="return false;"  maxlength="15" autocomplete="off" required>

				</div> 
			  </div>
			  </div>
			 
              
  
			 
              
       

			 </div>
			 
			 	<div class="agileinfo-row w3ls-row2"> 
			 
			       
			         <div class="form-group">
			   <label for="telefono" class="col-sm-3 control-label">Telefono #2 </label>
				<div class="col-sm-8">
			  	 <div class="input-group">
			  	  <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
				  <input  type="tel" class="form-control" id="telefono" name="telefono" placeholder="22345678" pattern="^[9
				  |8|3|2]\d{7}$"  title="min 8 numeros solo" style="text-transform: uppercase;"  onPaste="return false;"  maxlength="15" autocomplete="off" required>
				</div> 
			  </div>
			  </div>
			             
			  <div class="form-group">
				<label for="correo_electronico" class="col-sm-3 control-label">Correo Electronico</label>
				 <div class="col-sm-8">
			  	  <div class="input-group">
			  	   <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				    <input title="E-mail" type="email" class="form-control" id="correo_electronico" name="correo_electronico" placeholder="Correo Electronico" maxlength="80" onPaste="return false;" required autocomplete="off">
					</div>
				  </div>
				</div>
				
			  <div class="form-group">
			   <label for="direccion" class="col-sm-3 control-label">Direccion</label>
				<div class="col-sm-8">
			  	 <div class="input-group">
			  	  <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
				  <textarea input  class="form-control" id="direccion" name="direccion" placeholder="Direccion" pattern="[a-zA-Z0-9]{2,64}" title="Usuario"   onPaste="return false;" autocomplete="off"></textarea>
				</div> 
			  </div>
			  </div>
				

			   
                            
      
         
              
			 </div>
		 
		 

                                    
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Guardar</button>
                                           
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </div>












</section>
<!--main content end-->
</section>
   
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
<script src="js/toastr.min.js"></script>
<!-- calendar -->
	<script type="text/javascript" src="js/monthly.js"></script>
	<script>

$(document).on('submit', '#loginform', function(event) {
		event.preventDefault();
		$.ajax({
			url: 'save_clie.php',
			type: 'POST',
			dataType: 'JSON',
			data: $(this).serialize(),
			success:function(data){
	
				toastr.options.timeOut = 2000;
				// toastr.options.showMethod = 'fadeIn';
				// toastr.options.hideMethod = 'fadeOut';
				// toastr.options.positionClass = 'toast-top-center';
				
				if(data=="ok"){
					toastr.success("Guardado con exito.");
					setTimeout(function(){
						location.href="clientes.php";
					},2000);
				}
			
				else{
					toastr.error(data);
				}
			}
		})
	});

	</script>
	<!-- //calendar -->
</body>
</html>
