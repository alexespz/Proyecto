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

    $('#volverMenu').hover(function(){
        $('#volverMenu').css({"cursor": "pointer"});
    }, function(){
        $('#volverMenu').css({"cursor": "auto"});
    });

    $('#cerrarSesion').hover(function(){
        $('#cerrarSesion').css({"cursor": "pointer"});
    }, function(){
        $('#cerrarSesion').css({"cursor": "auto"});
    });

    $('#editarPerfil').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("../paginasmodificarPerfil.php");
    });

    $('#cambiarContrasena').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("../paginas/modificarContrasena.php");
    });


    $('#verPerfil').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("../paginas/consultarPerfil.php");
    });

    $('#volverMenu').on("click", function(e){
        e.preventDefault();
        window.location = "../paginas/paginaPrincipal.php";
    });

    $('#cerrarSesion').on('click', function(){
        window.location = "../paginas/cerrarSesion.php";
    });
});

function modificarUsuario(user) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../paginas/modificarUsuario.php",
        data: "usuario="+user,
        success: function(resp){
            $('#cuerpo').load("modificarUsuario.php");
        }
    });
}

function cargarPerfil() {
    $.ajax({
        async: true,
        type: "POST",
        url: "../paginas/modificarPerfil.php",
        success: function(resp){
            $('#cuerpo').load("modificarPerfil.php");
        }
    });
}

function cambiarContrasena(newPass, repeatPass) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/perfil/modificarContrasena.php",
        data: "nuevaContrasena="+newPass+"&repetirContrasena="+repeatPass,
        success: function(resp){
            $('#resultado').html(resp);
        }
    });
}

function modificarPerfil(nombre, apellidos, email, telefono, sexo, dni) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/perfil/modificarPerfil.php",
        data: "nombre="+nombre+"&apellidos="+apellidos+"&email="+email+"&telefono="+telefono+"&sexo="+sexo+"&dni="+dni,
        success: function(resp){
            $('#resultado').html(resp);
        }
    });
}

function cambiarUsuario(oldUser, newUser) {
    $.ajax({
        async: true,
        type: "POST",
        url: "../consultas/perfil/modificarUsuario.php",
        data: "usuarioAntiguo="+oldUser+"&usuarioNuevo="+newUser,
        success: function(resp){
            $('#resultado').html(resp);
        }
    });
}