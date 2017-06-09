<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../procedimientos/carrito.php';

$carrito = new Carrito();
$conexion = new procedimientos();
$conexion->conect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mi Pedido</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script>
        function realizarPedido(total) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/realizarPedido.php",
                data: "total=" + total,
                success: function (resp) {
                    $('#resultado').html(resp);
                }
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
                <div id="title-cdi">MI PEDIDO</div>
            </div>
        </div>
    </header>
    <hr>
    <!-- CUERPO DE LA PÁGINA -->
    <div class="col-md-8" id="cuerpo">
        <div class="tab-content clearfix" id="contenidoPedido">
            <table class="table table-striped table-responsive col-md-9">
                <tr>
                    <td class="col-md-1">ID Producto</td>
                    <td class="col-md-3">Nombre</td>
                    <td class="col-md-1">Cantidad</td>
                    <td class="col-md-1">Precio</td>
                    <td class="col-md-3">Acciones</td>
                </tr><?php
                $carro = $carrito->get_content();
                foreach($carro as $producto){
                    $idUnica = $producto["unique_id"]; echo '
                <tr>
                    <td class="col-md-1">'.$producto["unique_id"].'</td>
                    <td class="col-md-3">'.$producto["nombre"].'</td>
                    <td class="col-md-1">'.$producto["cantidad"].'</td>
                    <td class="col-md-1">'.$producto["precio"].' €</td>
                    <td class="col-md-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal" href="../consultas/obtenerModal.php?id='.$producto["id"].'"><span class="fa fa-eye"></span></button>
                        <button type="button" class="btn btn-danger" onclick="'.$carrito->remove_producto("$idUnica").'"><span class="glyphicon glyphicon-remove"></span></button>
                    </td>
                </tr>';
                }echo '
            </table>
                <p>Productos del carrito: '.$carrito->articulos_total().'</p>
                <p>Total: '.$carrito->precio_total().' €</p>
                <button class="btn btn-warning" onclick="realizarPedido('.$carrito->precio_total().');"">Realizar Pedido</button>';?>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
        </div>
    </div>
</div>
</body>
</html>