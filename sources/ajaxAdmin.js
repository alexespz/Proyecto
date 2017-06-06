
$(document).ready(function() {
    $('#listadoProductos').hover(function(){
        $('#listadoProductos').css({"cursor": "pointer"});
    }, function(){
        $('#listadoProductos').css({"cursor": "auto"});
    });

    $('#nuevosProductos').hover(function(){
        $('#nuevosProductos').css({"cursor": "pointer"});
    }, function(){
        $('#nuevosProductos').css({"cursor": "auto"});
    });

    $('#listadoTipos').hover(function(){
        $('#listadoTipos').css({"cursor": "pointer"});
    }, function(){
        $('#listadoTipos').css({"cursor": "auto"});
    });

    $('#nuevosTipos').hover(function(){
        $('#nuevosTipos').css({"cursor": "pointer"});
    }, function(){
        $('#nuevosTipos').css({"cursor": "auto"});
    });

    $('#listadoHoras').hover(function(){
        $('#listadoHoras').css({"cursor": "pointer"});
    }, function(){
        $('#listadoHoras').css({"cursor": "auto"});
    });

    $('#nuevasHoras').hover(function(){
        $('#nuevasHoras').css({"cursor": "pointer"});
    }, function(){
        $('#nuevasHoras').css({"cursor": "auto"});
    });

    $('#listadoAlergenos').hover(function(){
        $('#listadoAlergenos').css({"cursor": "pointer"});
    }, function(){
        $('#listadoAlergenos').css({"cursor": "auto"});
    });

    $('#nuevosAlergenos').hover(function(){
        $('#nuevosAlergenos').css({"cursor": "pointer"});
    }, function(){
        $('#nuevosAlergenos').css({"cursor": "auto"});
    });

    $('#cerrarSesion').hover(function(){
        $('#cerrarSesion').css({"cursor": "pointer"});
    }, function(){
        $('#cerrarSesion').css({"cursor": "auto"});
    });

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

    $('#cerrarSesion').on('click', function(){
        window.location = "../paginas/cerrarSesion.php";
    });
});
