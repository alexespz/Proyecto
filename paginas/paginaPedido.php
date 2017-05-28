<?php
session_start();
include_once '../procedimientos/procedimientos.php';

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
        $(window).on('load', function(){
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/obtenerProductos.php",
                data: "tipo="+1,
                success: function(resp){
                    $('#entrantes').attr('class', 'active');
                    $('#ensaladas').attr('class', '');
                    $('#carnes').attr('class', '');
                    $('#pescados').attr('class', '');
                    $('#bebidas').attr('class', '');
                    $('#postres').attr('class', '');
                    $('#ensaladas').empty();
                    $('#carnes').empty();
                    $('#pescados').empty();
                    $('#bebidas').empty();
                    $('#postres').empty();

                    $('#entrantes').html(resp);
                }
            });

            $(document).ready(function() {
                $('#Modal').on('hidden.bs.modal', function () {
                    $(this).removeData('bs.modal');
                });
            });
        });

        function ValidarEnsaladas(tipo) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/obtenerProductos.php",
                data: "tipo="+tipo,
                success: function(resp){
                    $('#ensaladas').attr('class', 'active');
                    $('#entrantes').attr('class', '');
                    $('#carnes').attr('class', '');
                    $('#pescados').attr('class', '');
                    $('#bebidas').attr('class', '');
                    $('#postres').attr('class', '');
                    $('#entrantes').empty();
                    $('#carnes').empty();
                    $('#pescados').empty();
                    $('#bebidas').empty();
                    $('#postres').empty();

                    $('#ensaladas').html(resp);
                }
            });

            $(document).ready(function() {
                $('#Modal').on('hidden.bs.modal', function () {
                    $(this).removeData('bs.modal');
                });
            });
        }
        function ValidarEntrantes(tipo) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/obtenerProductos.php",
                data: "tipo="+tipo,
                success: function(resp){
                    $('#entrantes').attr('class', 'active');
                    $('#ensaladas').attr('class', '');
                    $('#carnes').attr('class', '');
                    $('#pescados').attr('class', '');
                    $('#bebidas').attr('class', '');
                    $('#postres').attr('class', '');
                    $('#ensaladas').empty();
                    $('#carnes').empty();
                    $('#pescados').empty();
                    $('#bebidas').empty();
                    $('#postres').empty();

                    $('#entrantes').html(resp);
                }
            });

            $(document).ready(function() {
                $('#Modal').on('hidden.bs.modal', function () {
                    $(this).removeData('bs.modal');
                });
            });
        }
        function ValidarCarnes(tipo) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/obtenerProductos.php",
                data: "tipo="+tipo,
                success: function(resp){
                    $('#carnes').attr('class', 'active');
                    $('#entrantes').attr('class', '');
                    $('#ensaladas').attr('class', '');
                    $('#pescados').attr('class', '');
                    $('#bebidas').attr('class', '');
                    $('#postres').attr('class', '');
                    $('#entrantes').empty();
                    $('#ensaladas').empty();
                    $('#pescados').empty();
                    $('#bebidas').empty();
                    $('#postres').empty();

                    $('#carnes').html(resp);
                }
            });

            $(document).ready(function() {
                $('#Modal').on('hidden.bs.modal', function () {
                    $(this).removeData('bs.modal');
                });
            });
        }
        function ValidarPescados(tipo) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/obtenerProductos.php",
                data: "tipo="+tipo,
                success: function(resp){
                    $('#pescados').attr('class', 'active');
                    $('#entrantes').attr('class', '');
                    $('#carnes').attr('class', '');
                    $('#ensaladas').attr('class', '');
                    $('#bebidas').attr('class', '');
                    $('#postres').attr('class', '');
                    $('#entrantes').empty();
                    $('#carnes').empty();
                    $('#ensaladas').empty();
                    $('#bebidas').empty();
                    $('#postres').empty();

                    $('#pescados').html(resp);
                }
            });

            $(document).ready(function() {
                $('#Modal').on('hidden.bs.modal', function () {
                    $(this).removeData('bs.modal');
                });
            });
        }
        function ValidarBebidas(tipo) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/obtenerProductos.php",
                data: "tipo="+tipo,
                success: function(resp){
                    $('#bebidas').attr('class', 'active');
                    $('#entrantes').attr('class', '');
                    $('#carnes').attr('class', '');
                    $('#pescados').attr('class', '');
                    $('#ensaladas').attr('class', '');
                    $('#postres').attr('class', '');
                    $('#entrantes').empty();
                    $('#carnes').empty();
                    $('#pescados').empty();
                    $('#ensaladas').empty();
                    $('#postres').empty();

                    $('#bebidas').html(resp);
                }
            });

            $(document).ready(function() {
                $('#Modal').on('hidden.bs.modal', function () {
                    $(this).removeData('bs.modal');
                });
            });
        }
        function ValidarPostres(tipo) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/obtenerProductos.php",
                data: "tipo="+tipo,
                success: function(resp){
                    $('#postres').attr('class', 'active');
                    $('#entrantes').attr('class', '');
                    $('#carnes').attr('class', '');
                    $('#pescados').attr('class', '');
                    $('#bebidas').attr('class', '');
                    $('#ensaladas').attr('class', '');
                    $('#entrantes').empty();
                    $('#carnes').empty();
                    $('#pescados').empty();
                    $('#bebidas').empty();
                    $('#ensaladas').empty();

                    $('#postres').html(resp);
                }
            });

            $(document).ready(function() {
                $('#Modal').on('hidden.bs.modal', function () {
                    $(this).removeData('bs.modal');
                });
            });
        }
    </script>
</head>

<body>

<div class="container caja">
    <!-- CABECERA -->
    <header>
        <div class="row vertical-align text-center">
            <div class="col-md-3 col-sm-3">
                <div id="title-cdi">REALIZAR PEDIDO</div>
            </div>
        </div>
    </header>
    <hr>
    <!-- CUERPO DE LA PÁGINA -->
    <div class="col-md-8" id="cuerpo">
        <ul class="nav nav-tabs">
            <li class="active"><a onclick="ValidarEntrantes(1)"; data-toggle="tab">ENTRANTES</a></li>
            <li><a onclick="ValidarEnsaladas(2)"; data-toggle="tab">ENSALADAS</a></li>
            <li><a onclick="ValidarCarnes(3)"; data-toggle="tab">CARNES</a></li>
            <li><a onclick="ValidarPescados(4)"; data-toggle="tab">PESCADOS</a></li>
            <li><a onclick="ValidarBebidas(5)"; data-toggle="tab">BEBIDAS</a></li>
            <li><a onclick="ValidarPostres(6)"; data-toggle="tab">POSTRES</a></li>
        </ul>

        <div class="tab-content clearfix" id="contenidoProductos">
            <div class="tab-pane active" id="entrantes">

            </div>
            <div class="tab-pane" id="ensaladas">

            </div>
            <div class="tab-pane" id="carnes">

            </div>
            <div class="tab-pane" id="pescados">

            </div>
            <div class="tab-pane" id="bebidas">

            </div>
            <div class="tab-pane" id="postres">

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3" >
                <div class="panel-group" id="accordion" >
                    <div class="panel panel-default">
                        <div class="panel-heading" >
                            <h4 class="panel-title ">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <span class="glyphicon glyphicon-book text-success"></span> Tu Pedido</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body" id="pedido">

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="../paginas/paginaPrincipal.php"><span class="glyphicon glyphicon-log-out text-success"></span> Vovler al Menu Principal</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
