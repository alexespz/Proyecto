$(window).on('load', function(){
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/obtenerProductos.php",
        data: "tipo="+1,
        success: function(resp){
            $('#productos').attr('class', 'active');
            $('#productos').empty();

            $('#productos').html(resp);
        }
    });

    $(document).on('hidden.bs.modal','#Modal', function () {
        $('#Modal').removeData('bs.modal');
    });
});

function validarTipo(tipo){
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/obtenerProductos.php",
        data: "tipo="+tipo,
        success: function(resp){
            $('#productos').attr('class', 'active');
            $('#productos').empty();

            $('#productos').html(resp);
        }
    });
}