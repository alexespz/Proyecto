$(document).ready(function(){
    //Estilos al pasar el raton por las diferentes opciones.
    $('#reserva').hover(function(){
        $('#reserva').css({"transform": "scale(1.2,1.2)", "transition": "all .2s ease-in-out", "cursor": "pointer", "color": "rgb(122,0,38)"});
    }, function(){
        $('#reserva').css({"transform": "scale(1,1)", "transition": "all .2s ease-in-out", "cursor": "auto", "color": "black"});
    });

    $('#pedido').hover(function(){
        $('#pedido').css({"transform": "scale(1.2,1.2)", "transition": "all .2s ease-in-out", "cursor": "pointer", "color": "rgb(122,0,38)"});
    }, function(){
        $('#pedido').css({"transform": "scale(1,1)", "transition": "all .2s ease-in-out", "cursor": "auto", "color": "black"});
    });

    $('#perfil').hover(function(){
        $('#perfil').css({"transform": "scale(1.2,1.2)", "transition": "all .2s ease-in-out", "cursor": "pointer", "color": "rgb(122,0,38)"});
    }, function(){
        $('#perfil').css({"transform": "scale(1,1)", "transition": "all .2s ease-in-out", "cursor": "auto", "color": "black"});
    });

    $('#cerrar').hover(function(){
        $('#cerrar').css({"transform": "scale(1.2,1.2)", "transition": "all .2s ease-in-out", "cursor": "pointer", "color": "rgb(122,0,38)"});
    }, function(){
        $('#cerrar').css({"transform": "scale(1,1)", "transition": "all .2s ease-in-out", "cursor": "auto", "color": "black"});
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