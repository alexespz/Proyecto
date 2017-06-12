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
    <title>Pagina pedido</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Merriweather:300,400italic,300italic,400,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../sources/animate.css">
    <link rel="stylesheet" href="../sources/style.css">
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
                <div class="col-md-6">
                    <div class="fh5co-food-menu to-animate-2">
                        <h2 class="fh5co-starters">Entrantes</h2>
                        <ul>
                            <?php
                            $query = "SELECT * FROM producto INNER JOIN tipo_producto ON (producto.tipo_producto = tipo_producto.id_tipo_producto) WHERE tipo_producto.nombre = 'Entrantes'";
                            $conexion->consultas($query);
                            while($resultado = $conexion->devolverFilas()){ echo '
                                    <li>
                                        <div class="fh5co-food-desc">
                                            <figure> <img src="../imagenes/productos/'.$resultado["foto"].'" class="img-responsive"></figure>
                                            <div>
                                                <h3>'.$resultado["nombre"].'</h3>
                                                <p>'.$resultado["descripcion"].'</p>
                                            </div>
                                        </div>
                                        <div class="fh5co-food-pricing">
                                            '.$resultado["precio"].' €
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal" href="../consultas/obtenerModal.php?id='.$resultado["id_producto"].'"><span class="fa fa-eye"></span></button> 
                                            <button type="button" class="btn btn-success" onclick="aniadirProducto('.$resultado["id_producto"].')"><span class="fa fa-plus"></span></button>
                                        </div>
                                    </li>';
                            }
                            ?>
                        </ul>
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