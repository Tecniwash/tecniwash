
<?php
session_start();

 require 'funcs/conexion.php';

if(isset($_POST['dataidobat'])) {
	$codigo = $_POST['dataidobat'];

 
  $query = mysqli_query($mysqli, "SELECT codigo_producto,precio_producto,nombre_producto,cant FROM products WHERE id_producto='$codigo'")
                                  or die('error '.mysqli_error($mysqli));


  $data = mysqli_fetch_assoc($query);

  $stock   = $data['precio_producto'];
  $unidad = 'Lps';

	if($stock != '') {
		echo "<div class='form-group'>
                <label class='col-sm-3 control-label'>Precio</label>
                <div class='col-sm-6'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stock' value='$stock' readonly>
                    <span class='input-group-addon'>$unidad</span>
                  </div>
                </div>
              </div>";
	} else {
		echo "<div class='form-group'>
                <label class='col-sm-3 control-label'>Precio</label>
                <div class='col-sm-6'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stock' value='0' readonly>
                    <span class='input-group-addon'></span>
                  </div>
                </div>
              </div>";
	}		
}
?> 