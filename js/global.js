$(function(){

    var removerServicio = function(e){
        e.preventDefault();
        $(this).closest('tr').remove();
    }

    var showLoading = function(){
        $('#loading').show();
    }

    var hideLoading = function(){
        $('#loading').hide();
    }

    var generarModal = function(titulo, contenido){
        if( !$('#miModal').length ){
            $('<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog "><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="myModalLabel">Modal title</h4></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button></div></div></div></div>').appendTo('html');
            $('#miModal').on('show.bs.modal',hideLoading);
        }
        var modal = $('#miModal');
        $('h4.modal-title',modal).html(titulo);
        $('div.modal-body',modal).html(contenido);
        modal.modal('show');
    }

    var mostrarConsulta = function(e){
        e.preventDefault();
        var $this = $(this);
        showLoading();
        $.get(
            $this.attr('href'),
            function(data){
                var response = $("#reporte", data);
                generarModal('Detalle de consulta', response);
            }
        );
    }


    /*Tooltip*/
    $('a[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    /*Cancelar*/
    $('.cancelForm').on('click',function(e){
    	e.preventDefault();
    	$(this).prop('disabled',true);
    	history.go(-1);
    });


    /*Redireccionar submit*/
    $('#submit a').on('click',function(e){
        e.preventDefault();
        var form = $('form#principal'),
            $this = $(this);
        if(!$('input#redirect').length){
            $('<input type="hidden" name="redirect" id="redirect">').prependTo(form);
        }
        $('input#redirect').val($this.attr('href'));
        $('#submit-button').trigger('click');
    });

    /*Datepicker*/
    $(".datepicker").datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true,
        todayHighlight: true
    });

    /*related select*/
    $('select#idEspecie').on('change',function(){
        var idEspecie = $(this).val(),
            selectRaza = $('select#idRaza');
        $('option',selectRaza).hide().filter('[data-id-especie="'+idEspecie+'"],[data-id-especie=""]').show();
        selectRaza.val('');
    }).trigger('change');

    /*DataTable*/
    if(jQuery().DataTable) {
        $('#tableListar').DataTable({
            "order": [ 0, 'desc' ],
            "language": {
                "lengthMenu"            : "&nbsp;&nbsp;&nbsp;&nbsp;Mostrar&nbsp;&nbsp; _MENU_ &nbsp;&nbsp; Registros por página",
                "zeroRecords"           : "No se encontraron resultados",
                "info"                  : "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty"             : "No hay registros disponibles",
                "infoFiltered"          : "(filtrado de _MAX_ registros totales)",
                "sSearch"               : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buscar   &nbsp;&nbsp;&nbsp;&nbsp;  ",
                "sSearchPlaceholder"    : 'Buscar  ',
                "oPaginate"             : {
                    "sFirst"                : "Primero",
                    "sPrevious"             : "Anterior", 
                    "sNext"                 : "Siguiente",
                    "sLast"                 : "Último"
                }
            }
        });
    }

    /*DataTable*/
    if(jQuery().validator) {
        $('form#principal').validator();
    }

    /*Agregar Servicio*/
    $('#btnAgregarServicio').on('click',function(e){
        e.preventDefault();
        var idServicio      = $('#id_servicio').val(),
            nomServicio     = $('#id_servicio option:selected').text(),
            precioSugerido  = $('#id_servicio option:selected').data('precio'),
            observacion     = $('#observacion').val();

        if(!idServicio){
            alert('Por favor, seleccione un servicio');
        }else{
            var fila = $('<tr>');

            var inputId = $('<input>').prop({
                name    : 'servicios[]',
                value   : idServicio,
                type    : 'hidden'
            });

            var inputPrecio = $('<input>').prop({
                name    : 'preciosSugeridos[]',
                value   : precioSugerido,
                type    : 'hidden'
            });

            var inputObs = $('<textarea>').prop({name : 'observaciones[]' }).html(observacion).addClass('hidden');

            $('<td>').html(nomServicio).append(inputId).append(inputObs).append(inputPrecio).appendTo(fila);

            //TODO pasar a multiline
            $('<td>').html(observacion).appendTo(fila);

            $('<td>').html(precioSugerido).appendTo(fila);

            var cerrar = $('<a href="#" title="Eliminar consulta"><span class="glyphicon glyphicon-remove"></span></a>');
            cerrar.addClass('removeItemConsulta').on('click',removerServicio);

            $('<td>').append(cerrar).appendTo(fila);

            $('#tblServicios tbody').append(fila);

            $('#id_servicio').val('');
            $('#observacion').val('');
        }
    });

    $('.removeItemConsulta').on('click',removerServicio);

    /*Consultar consulta*/
    $('.btnConsultar').on('click',mostrarConsulta);

});