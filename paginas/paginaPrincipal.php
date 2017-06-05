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
    <script src="../sources/ajaxMenuPrincipal.js"></script>
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

