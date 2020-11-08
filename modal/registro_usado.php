<script type="text/javascript">
function tampil_obat(input) {
    var num = input.value;

    $.post("productos_atencion.php", {
        dataidobat: num,
    }, function(response) {
        $('#stok').html(response)

        document.getElementById('jumlah_masuk').focus();
    });
}

function cek_jumlah_masuk(input) {
    jml = document.formObatMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
        alert('Jumlah Masuk Tidak Boleh Nol !!');
        input.value = input.value.substring(0, input.value.length - 1);
    }
}

function hitung_total_stok() {
    bil1 = document.guardar_usuario.stok.value;
    bil2 = document.guardar_usuario.jumlah_masuk.value;
    tt = document.guardar_usuario.transaccion.value;

    if (bil2 == "") {
        var hasil = "";
    } else {
        var salida = eval(bil1) - eval(bil2);
        var hasil = eval(bil1) + eval(bil2);
    }

    if (tt == "Salida") {
        document.guardar_usuario.total_stok.value = (salida);
    } else {
        document.guardar_usuario.total_stok.value = (hasil);
    }

}
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar producto o servicio </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
                    <div id="resultados_ajax"></div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label">Servicio</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="codigo" id="codigo"
                                data-placeholder="-- Seleccionar Medicamento --" onchange="tampil_obat(this)"
                                autocomplete="off" required>
                                <option value="">SELECCIONE UN PRODUCTO</option>
                                <?php
                      $query_obat = mysqli_query($mysqli, "SELECT  id_producto,codigo_producto, nombre_producto FROM products  ORDER BY nombre_producto ASC") or die('error '.mysqli_error($mysqli));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[id_producto]\"> $data_obat[codigo_producto] | $data_obat[nombre_producto] </option>";
                      }
                    ?>
                            </select>
                        </div>
                    </div>


                    <input type="hidden" class="" id="nom" name="nom" placeholder="" maxlength="80" onPaste="return false;"
                        required autocomplete="off">
                    <input type="hidden" class="" id="mas" name="mas" placeholder="" maxlength="80" onPaste="return false;"
                        required autocomplete="off">

                    <div class="form-group">
                        <label for="costo" class="col-sm-3 control-label">Cantidad</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span>
                                <input title="" type="number" value="1" min="1" class="form-control" id="costo"
                                    name="costo" maxlength="80" onPaste="return false;" required autocomplete="off">
                            </div>
                        </div>
                    </div>



                    <span id='stok'>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Precio</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="stock" name="stock" readonly required>
                            </div>
                        </div>
                    </span>




                    <div class="modal-footer">
                        <button title="Cerrar ventana" type="button" class="btn btn-default"
                            data-dismiss="modal">Cerrar</button>
                        <button title="Guardar Datos" type="submit" class="btn btn-primary" id="guardar_datos">Guardar
                            datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
    $("#guardar_usuario").submit(function(event) {
        $('#guardar_datos').attr("disabled", true);
        console.log("test");

        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "ajax/nuevo_usado.php",
            data: parametros,
            beforeSend: function(objeto) {
                $("#resultados_ajax").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#resultados_ajax").html(datos);
                $('#guardar_datos').attr("disabled", false);
                load(1);

            }

        });
        event.preventDefault();
    })
    </script>