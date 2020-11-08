$(document).on('ready', constructor);
                    function constructor()
                    {
                        multiplicar();
                        
                    }
                function multiplicar()
                    {
                    $('#contenido') .on('change', '#precio, #cantidad', function(){
                        var cant = parseInt($('#cantidad').val());
                        var pre = parseInt($('#precio').val());
                    if (isNaN(cantidad)){
                        cantidad = 0;
                    }
                    if (isNaN(pre)){
                        pre = 0;
                    }
                    $('#total').val(cant * pre);
                })
                }
                