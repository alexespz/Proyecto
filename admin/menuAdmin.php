<?php
session_start();
include_once '../procedimientos/procedimientos.php';

if(!isset($_SESSION["usuario"])){
    header("Location: index.html");
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
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap2-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap2-toggle.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script type="text/javascript" src="../sources/ajaxAdmin.js"></script>
</head>
<body>
<div class="container caja">
    <!-- CABECERA -->
    <header>
        <div class="row vertical-align text-center">
            <div class="col-md-3 col-sm-3">
                <div id="title-cdi">PANEL ADMINISTRADOR</div>
            </div>
        </div>
    </header>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3" >
                <div class="panel-group" id="accordion" >
                    <div class="panel panel-default">
                        <div class="panel-heading" >
                            <h4 class="panel-title ">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <span class="glyphicon glyphicon-book text-success"></span> Productos</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table table-striped col-md-8">
                                    <tr>
                                        <td><a id="listadoProductos">Listado de productos</a></td>
                                    </tr>
                                    <tr>
                                        <td><a id="nuevosProductos">Añadir nuevos productos</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" >
                            <h4 class="panel-title ">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    <span class="glyphicon glyphicon-book text-success"></span> Tipos de Productos</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table table-striped col-md-8">
                                    <tr>
                                        <td><a id="listadoTipos">Listado de Tipos</a></td>
                                    </tr>
                                    <tr>
                                        <td><a id="nuevosTipos">Añadir nuevo tipo</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" >
                            <h4 class="panel-title ">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    <span class="glyphicon glyphicon-book text-success"></span> Horas de reserva</a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table table-striped col-md-8">
                                    <tr>
                                        <td><a id="listadoHoras">Listado de horas</a></td>
                                    </tr>
                                    <tr>
                                        <td><a id="nuevasHoras">Añadir nueva hora</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" >
                            <h4 class="panel-title ">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                    <span class="glyphicon glyphicon-book text-success"></span> Tipos de alergenos</a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table table-striped col-md-8">
                                    <tr>
                                        <td><a id="listadoAlergenos">Listado de alergenos</a></td>
                                    </tr>
                                    <tr>
                                        <td><a id="nuevosAlergenos">Añadir nuevo alergeno</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CUERPO DE LA PÁGINA -->
            <div class="col-md-8" id="cuerpo">

            </div>
        </div>
    </div>

</div>
</body>
</html>
