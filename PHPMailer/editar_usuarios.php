	<?php
require_once ("funcs/conexion.php");
$consulta="select id_rol, rol from tbl_roles";
		$result=mysqli_query($mysqli, $consulta) or die (mysqli_error($mysqli));
            
            
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar usuario</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="nombre_usuario" class="col-sm-3 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Nombres" required>
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="usuario" class="col-sm-3 control-label">Usuario</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" required>
				</div>
			  </div>
			   <div class="form-group">
  <label class="col-md-3 control-label">Rol:</label>
    <div class="col-md-8 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
	<select name="rol" id='id_rol'class="form-control selectpicker" >
	<option value="" class="sel">--selecciones un rol--</option>
		<?php
		while($fila=mysqli_fetch_row($result)){
		echo "<option value='".$fila['0']."'>".$fila['1']."</option>";
		}?>
	</select>
        </div></div></div>
			  <div class="form-group">
				<label for="correo_electronico" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" placeholder="Correo electrónico" required>
				</div>
			  </div>
            	<div class="form-group">
  <label class="col-md-3 control-label">Estado:</label>
    <div class="col-md-8 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
		<select name="combo_estado" class="form-control">
			<option value="-1">--seleccione estado--</option>
			<option value="Bloqueado">Bloqueado</option>
			<option value="Activo">Activo</option>
			<option value="Inactivo">Inactivo</option>
			<option value="Nuevo">Nuevo</option>
		</select>
	 </div>
</div>
</div>
					 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	