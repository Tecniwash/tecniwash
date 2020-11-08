<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = '';
$type = 'success';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
}
$id_usu = $_SESSION['id_usuario'];

$edicion = 0;
$rol = 5;
$token = generateRandomString();

if (isset($_GET["idProduct"])) {
    $edicion = 1;
    $idProduct = $_GET["idProduct"];
    $arreglo = getArray("products", "id_producto", $idProduct);
    $codigo = $arreglo['codigo_producto'];
    $nombreProducto = $arreglo['nombre_producto'];
    $precioVenta = $arreglo['precio_producto'];
    $precioCompra = $arreglo['precio_costo'];
    $proveedor = $arreglo['proveedor'];
    $categoria = $arreglo['categorias'];
    $cantidad = $arreglo['cant'];
    $unidadGuardado = $arreglo['unidad'];
};

if (!empty($_POST)) {
    /* $post = file_get_contents('php://input');
    echo $post; */
    if (!empty($_POST['editMode'])){
        $idProduct = $_POST['editMode'];
        $nombre = $_POST['product_nombre'];
        $precio = $_POST['product_venta'];
        $precioCompra = $_POST['product_compra'];
        $proveedor = $_POST['product_supliers'];
        $unidades = $_POST['cantidad'];
        $unidadGuardado = $_POST['unidad_guardado'];
        $categoria = $_POST['categoria'];
        $sql = "UPDATE products
        SET nombre_producto = '$nombre',
        precio_producto = $precio,precio_costo = $precioCompra,cant = $unidades, 
        unidad = '$unidadGuardado',categorias = '$categoria',proveedor = '$proveedor'
        WHERE id_producto = $idProduct";
        global $mysqli;
        $conexion = $mysqli;
        if (mysqli_query($conexion, $sql)) {
            $errors = 'Se han actualizado los datos de el producto correctamente';
            $type = 'success';
        } else {
            $mensaje = mysqli_error($conexion);
            $errors = 'Hemos tenido el siguiente problema: a la hora de actualizar ' . $mensaje . '</br> Contacta tu Administrador';
            $type = 'warning';
        }
       // mysqli_close($conexion);
    }else{
    $nombre = $_POST['product_nombre'];
    $precio = $_POST['product_venta'];
    $precioCompra = $_POST['product_compra'];
    $proveedor = $_POST['product_supliers'];
    $unidades = $_POST['cantidad'];
    $unidadGuardado = $_POST['unidad_guardado'];
    $categoria = $_POST['categoria'];
    global $mysqli;
    $query_id = mysqli_query($mysqli, "SELECT RIGHT(codigo_producto,6) as codigo FROM products ORDER BY codigo DESC LIMIT 1") or die('error '.mysqli_error($mysqli));
    $data_id = mysqli_fetch_assoc($query_id);
    $codigo    = $data_id['codigo']+1;
    $buat_id   = str_pad($codigo, 6, "0", STR_PAD_LEFT);
    $codigo = "P$buat_id";
    $conexion = $mysqli;
    $consulta = "INSERT INTO bd_tw.products
    (codigo_producto,nombre_producto,status_producto,precio_producto,
    precio_costo,cant,tipo,unidad,categorias,proveedor)
    VALUES('$codigo','$nombre',1,$precio,$precioCompra,$unidades,0,'$unidadGuardado','$categoria','$proveedor');";
    if (mysqli_query($conexion, $consulta)) {
        $errors = 'Se ha ingresado el producto correctamente';
        $type = 'success';
    } else {
        $mensaje = mysqli_error($conexion);
        $errors = 'Hemos tenido el siguiente problema: ' . $mensaje . '</br> Contacta tu Administrador';
        $type = 'warning';
    }
    //mysqli_close($conexion);
    }
}
?>

<!DOCTYPE html>

<head>
    <title>Agregar Producto Nuevo</title>
    <link rel="icon" href="images\favicon\favicon.ico" type="image/ico" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <link rel="stylesheet" href="css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
    <script src="js/raphael-min.js"></script>
    <script src="js/morris.js"></script>
    <link rel="stylesheet  prefetch" href="css/bootstrap.min.css">
    <link rel="stylesheet  prefetch" href="css/bootstrap-theme32.min.css">
    <link rel="stylesheet  prefetch" href="css/bootstrapValidator32.min.css">

</head>

<body>
    <style>
        .form-w3layouts {
            background-color: #fff;
        }
    </style>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="" class="logo">
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

            </section>
            <div class="form-w3layouts">
                <!-- page start-->

                <?php
                if ($errors != '') {
                    echo showMessage($errors, $type);
                }
                ?>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php
                        if ($edicion != 0) {
                            echo "Editar  Producto";
                        } else {
                            echo "Agregar Nuevo Producto ";
                        } ?>
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>

                            <a class="fa fa-share" href="productos.php"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="cmxform form-horizontal" method="post" action="" novalidate="novalidate">
                            <?php if($edicion != 0){
                                ?>
                            <input type="hidden" id="usu" name="editMode" <?php echo "value='$idProduct'";  ?>>
                            <?php
                            }
                            ?>
                            <?php 
                                if ($edicion != 0){
                                    ?>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Codigo:</label>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-money-bill-wave"></i></span>
                                            <input readonly maxlength="15" type="text" name="product_venta" style="text-transform: uppercase;" id="txt_us" autocomplete="off" autofocus="on" onPaste="return false;" class="form-control" title="Recuerda ingresar un precio" <?php echo "value='$codigo'" ?>>
                                        </div>
                                    </div>
                                </div>
                                            <?php
                                            }
                                        ?>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Nombre Producto:</label>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-file-signature"></i></span>
                                            <input maxlength="70" type="text" <?php if ($edicion != 0) {
                                    echo "value='$nombreProducto'";
                                } ?> name="product_nombre" placeholder="Nombre" style="text-transform: uppercase;" id="txt_nc" autocomplete="off" autofocus="on" class="form-control" onkeypress="return soloLetras(event)" onPaste="return false;" title="Nombre Del Producto" required>
                                        </div>
                                    </div>
                                </div>

                                   <!-- Text input-->
                                   <div class="form-group">
                                    <label class="control-label col-lg-3">Precio de Venta:</label>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-money-bill-wave"></i></span>
                                            <input maxlength="15" type="number" name="product_venta" <?php if ($edicion != 0) {
                                                     echo "value='$precioVenta'";
                                                } ?> style="text-transform: uppercase;" id="txt_us" autocomplete="off" autofocus="on" onPaste="return false;" class="form-control" title="Recuerda ingresar un precio" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Precio de Compra:</label>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-money-bill-wave"></i></span>
                                            <input maxlength="15" type="number" name="product_compra" <?php if ($edicion != 0) {
                                                        echo "value='$precioCompra'";
                                                    } ?> style="text-transform: uppercase;" id="txt_us" autocomplete="off" autofocus="on" onPaste="return false;" class="form-control" title="Recuerda ingresar un precio" required> 
                                        </div>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                        <label class="control-label col-lg-3">Proveedor:</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group">
                                                <?php
                                                    global $mysqli;
                                                    $query = "select * from tbl_proveedores";
                                                    $result = mysqli_query($mysqli,$query) or die(mysql_error()."[".$query."]");
                                                ?>
                                                <span class="input-group-addon"><i class="fas fa-parachute-box"></i></span>
                                                <select class="form-control" id="exampleFormControlSelect1" name="product_supliers" title="Por favor seleccione un proveedor">
                                                    <?php
                                                    if($edicion != 0){
                                                        echo "<option value='$proveedor'>$proveedor</option>";
                                                        foreach ($result as $key => $value) {
                                                            if($value['nom_empresa'] != $proveedor)
                                                            echo "<option value='{$value['nom_empresa']}'>{$value['nom_empresa']}</option>";
                                                       }
                                                    }else{
                                                        foreach ($result as $key => $value) {
                                                            echo "<option value='{$value['nom_empresa']}'>{$value['nom_empresa']}</option>";
                                                       } 
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Text input-->
                                <div class="form-group">
                                        <label class="control-label col-lg-3">Categoria:</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group">
                                                <?php
                                                    global $mysqli;
                                                    $conexion = $mysqli;
                                                    $query = "select * from tbl_categorias";
                                                    $result = mysqli_query($conexion, $query) or die(mysql_error()."[".$query."]");
                                                ?>
                                                <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                                                <select class="form-control" id="exampleFormControlSelect1" name="categoria" title="Por favor seleccione un proveedor">
                                                    <?php
                                                    if($edicion != 0){
                                                        echo "<option value='$categoria'>$categoria</option>";
                                                        foreach ($result as $key => $value) {
                                                            if($value['nombre'] != $categoria){
                                                                echo "<option value='{$value['nombre']}'>{$value['nombre']}</option>";
                                                            }
                                                       }
                                                    }else {
                                                        foreach ($result as $key => $value) {
                                                            echo "<option value='{$value['nombre']}'>{$value['nombre']}</option>";
                                                       }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Text input-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Cantidad:</label>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-money-bill-wave"></i></span>
                                            <input maxlength="15" type="number" name="cantidad" <?php if ($edicion != 0) {
                                                        echo "value='$cantidad'";
                                                    } ?> style="text-transform: uppercase;" id="txt_us" autocomplete="off" autofocus="on" onPaste="return false;" class="form-control" title="Recuerda ingresar un precio" required> 
                                        </div>
                                    </div>
                                </div>

                                    <!-- Text input-->
                                 <div class="form-group">
                                        <label class="control-label col-lg-3">Unidad de guardado:</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fas fa-tags"></i></span>
                                                <select class="form-control" id="exampleFormControlSelect1" name="unidad_guardado" title="Por favor seleccione un proveedor">
                                                    <option value='Bolsa'>Bolsa</option>
                                                    <option value='Botes'>Botes</option>
                                                    <option value='Cajas'>Cajas</option>
                                                    <option value='Sobres'>Sobres</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-success" value="Guardar" type="submit">Guardar</button>
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

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

        //eliminar alerta despues de 5 segundos
        let alerta = document.getElementsByClassName('alert');
        setTimeout(function() {
            while (alerta.length > 0) {
                alerta[0].parentNode.removeChild(alerta[0]);
            }
        }, 5000);
    </script>

    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/jquery.scrollTo.js"></script>
    <!-- morris JavaScript -->
    <script src="js/toastr.min.js"></script>
    <!-- calendar -->
    <script type="text/javascript" src="js/monthly.js"></script>
    <!-- //calendar -->
    <script src="js\validaciones.js"></script>
</body>

</html>