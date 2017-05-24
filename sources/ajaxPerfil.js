$(document).ready(function(){
    $('#cuerpo').load('consultarPerfil.php');

    $('#editarPerfil').hover(function(){
        $('#editarPerfil').css({"cursor": "pointer"});
    }, function(){
        $('#perfil').css({"cursor": "auto"});
    });

    $('#cambiarContrasena').hover(function(){
        $('#cambiarContrasena').css({"cursor": "pointer"});
    }, function(){
        $('#cambiarContrasena').css({"cursor": "auto"});
    });

    $('#verPerfil').hover(function(){
        $('#verPerfil').css({"cursor": "pointer"});
    }, function(){
        $('#verPerfil').css({"cursor": "auto"});
    });

    $('#cerrarSesion').hover(function(){
        $('#cerrarSesion').css({"cursor": "pointer"});
    }, function(){
        $('#cerrarSesion').css({"cursor": "auto"});
    });

    $('#editarPerfil').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("modificarPerfil.php");
    });

    $('#cambiarContrasena').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("../paginas/modificarContrasena.php");
    });


    $('#verPerfil').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("../paginas/consultarPerfil.php");
    });

    $('#cerrarSesion').on('click', function(){
        window.location = "../paginas/cerrarSesion.php";
    });
});
