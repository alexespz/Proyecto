<?php
session_start();

if(!isset($_SESSION["usuario"])){
    header("Location: inicioSesion.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pagina principal</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script>
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
    </script>
</head>

<body>
    <div id="contenedorPrincipal" class="col-md-10" >
        <div id="reserva" class="col-md-3">
            <div class="text-center">
                <i class="fa fa-file-text-o fa-5x"></i>
            </div>
            <div class="text-center">
                <h2>REALIZAR RESERVA</h2>
            </div>
        </div>
        <div id="pedido" class="col-md-3">
            <div class="text-center">
                <i class="fa fa-list-alt fa-5x"></i>
            </div>
            <div class="text-center">
                <h2>REALIZAR PEDIDO</h2>
            </div>
        </div>
        <div id="perfil" class="col-md-3">
            <div class="text-center">
                <i class="fa fa-cog fa-5x"></i>
            </div>
            <div class="text-center">
                <h2>CONFIGURAR PERFIL</h2>
            </div>
        </div>
        <div id="cerrar" class="col-md-3">
            <div class="text-center">
                <i class="fa fa-sign-out fa-5x"></i>
            </div>
            <div class="text-center">
                <h2>CERRAR SESIÓN</h2>
            </div>
        </div>
    </div>
</body>
</html>

