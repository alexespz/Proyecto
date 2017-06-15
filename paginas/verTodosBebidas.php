<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../procedimientos/carrito.php';

$carrito = new Carrito();
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
    <title>Pagina pedido</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Merriweather:300,400italic,300italic,400,700italic' rel='stylesheet' type='text/css'>
    <!-- Animate.css -->
    <link rel="stylesheet" href="../sources/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../sources/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../sources/style.css">
    <!-- jQuery -->
    <script src="../sources/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="../sources/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="../sources/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="../sources/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="../sources/jquery.stellar.min.js"></script>
    <!-- Flexslider -->
    <script src="../sources/jquery.flexslider-min.js"></script>
    <!-- Main JS -->
    <script src="../sources/main.js"></script>
    <!-- Modernizr JS -->
    <script src="../sources/modernizr-2.6.2.min.js"></script>
    <script type="text/javascript" src="../sources/tabsPedido.js"></script>
    <script>
        function aniadirProducto(id) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/aniadirProducto.php",
                data: "id=" + id,
                success: function (resp) {
                    $('#pedido').html(resp);
                }
            });
        }
    </script>
</head>
<body>
<div class="container caja">
    <!-- CUERPO DE LA PÁGINA -->
    <div id="fh5co-menus" data-section="menu">
        <div class="container">
            <div class="row text-center fh5co-heading row-padded">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="heading to-animate">Realizar Pedido</h2>
                </div>
            </div>
            <div class="row row-padded">
                <div class="col-md-8">
                    <div class="fh5co-food-menu to-animate-2">
                        <h2 class="fh5co-drinks">Bebidas</h2>
                        <ul>
                            <?php
                            $query = "SELECT * FROM producto INNER JOIN tipo_producto ON (producto.tipo_producto = tipo_producto.id_tipo_producto) WHERE tipo_producto.nombre = 'Bebidas'";
                            $conexion->consultas($query);
                            while($resultado = $conexion->devolverFilas()){ echo '
                                <li>
                                    <div class="fh5co-food-desc">';
                                        if($resultado["foto"] == null ){echo'
                                            <figure> <img src="../imagenes/imagen-no-disponible.gif" class="img-responsive"></figure>';
                                        }else {echo'
                                            <figure> <img src="../imagenes/productos/'.$resultado["foto"].'" class="img-responsive"></figure>';
                                        }echo'
                                        <div>
                                            <h3>'.$resultado["1"].'</h3>
                                            <p>'.$resultado["descripcion"].'</p>
                                        </div>
                                    </div>
                                    <div class="fh5co-food-pricing">
                                        '.$resultado["precio"].' €
                                    </div>
                                    <div class="fh5co-food-pricing">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal" href="../consultas/obtenerModal.php?id='.$resultado["id_producto"].'"><span class="fa fa-eye"></span></button> 
                                        <button type="button" class="btn btn-success" onclick="aniadirProducto('.$resultado["id_producto"].')"><span class="fa fa-plus"></span></button>
                                    </div>
                                </li>';
                            }
                            ?>
                        </ul>
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
                                            <?php
                                            $carro = $carrito->get_content();
                                            if($carro == null) {
                                                echo 'No hay productos en el carrito';
                                            }else{echo'
                                                <table class="table table-striped col-md-9">
                                                <tr>
                                                    <td class="col-md-7">Producto</td>
                                                    <td class="col-md-1">Cantidad</td>
                                                    <td class="col-md-1">Precio</td>
                                                </tr>';
                                                $carro = $carrito->get_content();
                                                foreach($carro as $producto){echo'
                                                <tr>
                                                    <td class="col-md-7">'.$producto["nombre"].'</td>
                                                    <td class="col-md-1">'.$producto["cantidad"].'</td>
                                                    <td class="col-md-1">'.$producto["precio"].' €</td>
                                                </tr>';
                                                }echo '
                                                </table>
                                                <p>Total: '.$carrito->precio_total().' €</p>
                                                <hr/>
                                                <button type="button" class="btn btn-warning" onclick="realizarPedido('.$carrito->precio_total().');">Realizar Pedido</button>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="../paginas/paginaPedido.php"><span class="glyphicon glyphicon-arrow-left text-success"></span> Vovler</a>
                                        </h4>
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
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
        </div>
    </div>
</div>