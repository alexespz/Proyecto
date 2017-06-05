
$(document).ready(function() {
    $('#listadoProductos').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("listadoProductos.php");
    });

    $('#nuevosProductos').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("aniadirProductos.php");
    });

    $('#listadoTipos').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("listadoTiposProductos.php");
    });

    $('#nuevosTipos').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("aniadirTipoProducto.php");
    });

    $('#listadoHoras').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("listadoHoras.php");
    });

    $('#nuevasHoras').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("aniadirHora.php")
    });

    $('#listadoAlergenos').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("listadoAlergenos.php");
    });

    $('#nuevosAlergenos').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("aniadirAlergeno.php")
    });
});
