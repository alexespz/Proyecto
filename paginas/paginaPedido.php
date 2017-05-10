<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../consultas/obtenerProductos.php';

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
            <li class="active"><a href="#entrantes" data-toggle="tab">ENTRANTES</a></li>
            <li><a href="#ensaladas" data-toggle="tab">ENSALADAS</a></li>
            <li><a href="#carnes" data-toggle="tab">CARNES</a></li>
            <li><a href="#pescados" data-toggle="tab">PESCADOS</a></li>
            <li><a href="#bebidas" data-toggle="tab">BEBIDAS</a></li>
            <li><a href="#postres" data-toggle="tab">POSTRES</a></li>
        </ul>

        <div class="tab-content clearfix">
            <div class="tab-pane active" id="entrantes">
                <table class="table table-stripted col-md-9">
                    <tr>
                        <td class="col-md-8">Producto</td>
                        <td class="col-md-1">Precio</td>
                    </tr>
                    <tr>
                        <?php
                            echo '<td>HOLA</td>';
                        ?>
                    </tr>
                </table>
            </div>
            <div class="tab-pane" id="ensaladas">
                <h3>We use the class nav-pills instead of nav-tabs which automatically creates a background color for the tab</h3>
            </div>
            <div class="tab-pane" id="carnes">
                <h3>We applied clearfix to the tab-content to rid of the gap between the tab and the content</h3>
            </div>
            <div class="tab-pane" id="pescados">
                <h3>We use css to change the background color of the content to be equal to the tab</h3>
            </div>
            <div class="tab-pane" id="bebidas">
                <h3>We use css to change the background color of the content to be equal to the tab</h3>
            </div>
            <div class="tab-pane" id="postres">
                <h3>We use css to change the background color of the content to be equal to the tab</h3>
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
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <td>
                                            hola
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="cerrarSession.php"><span class="glyphicon glyphicon-log-out text-success"></span> Vovler al Menu Principal</a>
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
