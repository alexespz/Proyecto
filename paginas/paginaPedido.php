<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

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
    <script type="text/javascript" src="../sources/tabsPedido.js"></script>
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
        <ul class="nav nav-tabs"><?php
            $query = "SELECT * FROM tipo_producto";
            $conexion->consultas($query);
            while($resultado = $conexion->devolverFilas()){
                echo '<li class=""><a onclick="validarTipo('.$resultado["id_tipo_producto"].');" data-toggle="tab">'.$resultado["nombre"].'</a></li>';
            }?>
        </ul>
        <div class="tab-content clearfix" id="contenidoProductos">
            <div class="tab-pane active" id="productos">

            </div>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
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
