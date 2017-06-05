$(document).ready(function(){
    //Estilos al pasar el raton por las diferentes opciones.
    $('#reserva').hover(function(){
        $('#reserva').css({"background-color": "black", "transform": "scale(1.2,1.2)", "transition": "all .2s ease-in-out", "cursor": "pointer"});
    }, function(){
        $('#reserva').css({"background-color": "transparent", "transform": "scale(1,1)", "transition": "all .2s ease-in-out", "cursor": "auto"});
    });

    $('#pedido').hover(function(){
        $('#pedido').css({"background-color": "black", "transform": "scale(1.2,1.2)", "transition": "all .2s ease-in-out", "cursor": "pointer"});
    }, function(){
        $('#pedido').css({"background-color": "transparent", "transform": "scale(1,1)", "transition": "all .2s ease-in-out", "cursor": "auto"});
    });

    $('#perfil').hover(function(){
        $('#perfil').css({"background-color": "black", "transform": "scale(1.2,1.2)", "transition": "all .2s ease-in-out", "cursor": "pointer"});
    }, function(){
        $('#perfil').css({"background-color": "transparent", "transform": "scale(1,1)", "transition": "all .2s ease-in-out", "cursor": "auto"});
    });

    $('#cerrar').hover(function(){
        $('#cerrar').css({"background-color": "black", "transform": "scale(1.2,1.2)", "transition": "all .2s ease-in-out", "cursor": "pointer"});
    }, function(){
        $('#cerrar').css({"background-color": "transparent", "transform": "scale(1,1)", "transition": "all .2s ease-in-out", "cursor": "auto"});
    });

    //Localización a la que hace referencia cada elemento al hacer click sobre el.
    $('#reserva').on('click', function(){
        window.location = "../paginas/paginaReserva.php";
    });

    $('#pedido').on('click', function(){
        window.location = "../paginas/paginaPedido.php";
    });

    $('#perfil').on('click', function(){
        window.location = "../paginas/perfilPersonal.php";
    });

    $('#cerrar').on('click', function(){
        window.location = "../paginas/cerrarSesion.php";
    });
});