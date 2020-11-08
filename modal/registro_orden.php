
<script type="text/javascript">
  function tampil_obat(input){
    var num = input.value;

    $.post("medicines.php", {
      dataidobat: num,
    }, function(response) {      
      $('#stok').html(response)

      document.getElementById('jumlah_masuk').focus();
    });
  }

  function cek_jumlah_masuk(input) {
    jml = document.formObatMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if(jumlah < 1){
      alert('Jumlah Masuk Tidak Boleh Nol !!');
      input.value = input.value.substring(0,input.value.length-1);
    }
  }

  function hitung_total_stok() {
    bil1 = document.guardar_usuario.stok.value;
    bil2 = document.guardar_usuario.jumlah_masuk.value;
	tt = document.guardar_usuario.transaccion.value;
	
    if (bil2 == "") {
      var hasil = "";
    }
    else {
      var salida = eval(bil1) - eval(bil2);
	  var hasil = eval(bil1) + eval(bil2);
    }

	if (tt=="Salida"){
		document.guardar_usuario.total_stok.value = (salida);
	}	else {
		document.guardar_usuario.total_stok.value = (hasil);
	} 
    
  }
</script>
   <?php  
            require 'funcs/conexion.php';
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(codigo_transaccion,7) as codigo FROM transaccion_productos
                                                ORDER BY codigo_transaccion DESC LIMIT 1")
                                                or die('Error : '.mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                 
                  $data_id = mysqli_fetch_assoc($query_id);
                  $codigo    = $data_id['codigo']+1;
              } else {
                  $codigo = 1;
              }

             
              $tahun          = date("Y");
              $buat_id        = str_pad($codigo, 7, "0", STR_PAD_LEFT);
              $codigo_transaccion = "TM-$tahun-$buat_id";
              ?>


	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	     <link href="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> 
	  <script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<!-- Modal -->
	<div class="modal fade" id="myModal"  tabindex="1" role="dialog" aria-labelledby="myModalLabel">
	  <div  class="modal-dialog modal-lg-9" role="d class="modal-dialog modal-lg"t">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="location.reload();"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Transaccion de Inventario</h4>
		   </div>
		  <div class="modal-body">
		  
		  
		 <form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
		<div id="resultados_ajax"></div>

<center>
    <center>
         <div class="form-group">
			   <label for="tran" class="col-sm-3 control-label">Codigo </label>
				<div class="col-sm-6">
			  	 <div class="input-group">
			  	  <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
				  <input  type="" class="form-control" id="tran" name="tran" title="cod transaccion"onPaste="return false;"   value="<?php echo $codigo_transaccion; ?>"  autocomplete="off" readonly >
				</div> 
			  </div>
			  </div>
        
        
        
        
        
		  <div class="form-group">
				<label for="id_proveedor" class="col-sm-3 control-label">Proveedor</label>
				<div class="col-sm-6">
		  		<div class="input-group">
			  	<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
				<select title="Cliente" class='form-control' id="id_proveedor" name="id_proveedor" style="text-transform: uppercase;" >
				<?php 
				$query_cod_veh=mysqli_query($mysqli,"SELECT id_proveedor,nom_empresa from tbl_proveedores");
				while($rw=mysqli_fetch_array($query_cod_veh))	{
					?>
				<option value="<?php echo $rw['id_proveedor'];?>"><?php echo $rw['nom_empresa'];?></option>			
					<?php
				}

				?>
				</select>
				</div>
			  </div>
			 </div>
          
		      
		  </center>
		    <div class="form-group">
                <label class="col-sm-3 control-label">Fecha</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control date-picker" data-date-format="dd-mm-aaaa" name="fecha" id="fecha" autocomplete="off" value="<?php echo date("dd-mm-aaaa"); ?>" required>
                </div>
              </div>
    
      <div class="form-group">  
                <label class="col-sm-3 control-label">Producto</label>
                <div class="col-sm-6">
                  <select  class="form-control"  name="codigo" id="codigo" data-placeholder="-- Seleccionar Producto --" onchange="tampil_obat(this)" autocomplete="off" required>
                    <option value="">SELECCIONE UN PRODUCTO</option>
                    <?php
                      $query_obat = mysqli_query($mysqli, "SELECT codigo_producto, nombre_producto FROM products where tipo=0 ORDER BY nombre_producto ASC") or die('error '.mysqli_error($mysqli));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[codigo_producto]\"> $data_obat[codigo_producto] | $data_obat[nombre_producto] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
     <span id='stok'>
              <div class="form-group">
                <label class="col-sm-3 control-label">Stock</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="stok" name="stock" readonly required>
                </div>
              </div>
              </span>
    
      <div class="form-group">
                <label class="col-sm-3 control-label">Cantidad</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="jumlah_masuk" name="num" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_stok(this)&cek_jumlah_masuk(this)" required>
                </div>
              </div>
			  
			  <div class="form-group">
                <label class="col-sm-3 control-label">Transacción</label>
                <div class="col-sm-6">
                  <select name="transaccion" id="transaccion" required class='form-control' onchange="hitung_total_stok();">
                      	<option value="Entrada">Entrada</option>
					<option value="Salida">Salida</option>
				
				  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Total Stock</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="total_stok" name="total_stock" readonly required>
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
			   <label for="precio" class="col-sm-3 control-label">Precio</label>
				<div class="col-sm-6">
			  	 <div class="input-group">
			  	  <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
				  <input  type="text" class="form-control" id="precio" name="precio" placeholder="Precio"   title="Precio" maxlength="20" autocomplete="off" required>

				</div> 
			  </div>
			  </div>
			 
			 

			 
              
</center>
		 
		 
		 
		   <center>
		 
            

		   <div class="modal-footer">
			<button  onClick="location.reload();"title="Cerrar ventana" type="submit"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button title="Guardar Datos" type="submit" class="btn btn-primary"  id="guardar_datos">Guardar datos</button>
		  </div>
		  </center>
		  </form>
		 
		</div>
		  </div>
		</div>
		
	</div>
		
<script type="text/javascript">
		
		$(".my").select2();
		
	</script>	