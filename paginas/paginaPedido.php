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
                                $query = "SELECT * FROM producto INNER JOIN tipo_producto ON (producto.tipo_producto = tipo_producto.id_tipo_producto) WHERE tipo_producto.nombre = 'Entrantes' LIMIT 4";
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
                                            <button type="button" class="btn btn-success" onclick="aniadirProducto('.$resultado["id_producto"].')"><span class="fa fa-plus"></span></button>
                                        </div>
                                    </li>';
                                }
                            ?>
                        </ul>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center to-animate-2">
                                <p><a href="../paginas/verTodosEntrantes.php" class="btn btn-primary btn-outline">Ver mas entrantes</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fh5co-food-menu to-animate-2">
                        <h2 class="fh5co-salads">Ensaladas</h2>
                        <ul>
                            <?php
                            $query = "SELECT * FROM producto INNER JOIN tipo_producto ON (producto.tipo_producto = tipo_producto.id_tipo_producto) WHERE tipo_producto.nombre = 'Ensaladas' LIMIT 4";
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
                                            <button type="button" class="btn btn-success" onclick="aniadirProducto('.$resultado["id_producto"].')"><span class="fa fa-plus"></span></button>
                                        </div>
                                    </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fh5co-food-menu to-animate-2">
                        <h2 class="fh5co-meat">Carnes</h2>
                        <ul>
                            <?php
                            $query = "SELECT * FROM producto INNER JOIN tipo_producto ON (producto.tipo_producto = tipo_producto.id_tipo_producto) WHERE tipo_producto.nombre = 'Carnes' LIMIT 4";
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
                                            <button type="button" class="btn btn-success" onclick="aniadirProducto('.$resultado["id_producto"].')"><span class="fa fa-plus"></span></button>
                                        </div>
                                    </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fh5co-food-menu to-animate-2">
                        <h2 class="fh5co-fish">Pescados</h2>
                        <ul>
                            <?php
                            $query = "SELECT * FROM producto INNER JOIN tipo_producto ON (producto.tipo_producto = tipo_producto.id_tipo_producto) WHERE tipo_producto.nombre = 'Pescados' LIMIT 4";
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
                                            <button type="button" class="btn btn-success" onclick="aniadirProducto('.$resultado["id_producto"].')"><span class="fa fa-plus"></span></button>
                                        </div>
                                    </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fh5co-food-menu to-animate-2">
                        <h2 class="fh5co-drinks">Bebidas</h2>
                        <ul>
                            <?php
                            $query = "SELECT * FROM producto INNER JOIN tipo_producto ON (producto.tipo_producto = tipo_producto.id_tipo_producto) WHERE tipo_producto.nombre = 'Bebidas' LIMIT 4";
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
                                            <button type="button" class="btn btn-success" onclick="aniadirProducto('.$resultado["id_producto"].')"><span class="fa fa-plus"></span></button>
                                        </div>
                                    </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fh5co-food-menu to-animate-2">
                        <h2 class="fh5co-desserts">Postres</h2>
                        <ul>
                            <?php
                            $query = "SELECT * FROM producto INNER JOIN tipo_producto ON (producto.tipo_producto = tipo_producto.id_tipo_producto) WHERE tipo_producto.nombre = 'Postres' LIMIT 4";
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
    <!--<div class="col-md-8" id="cuerpo">
        <ul class="nav nav-tabs"><?php
            /*$query = "SELECT * FROM tipo_producto";
            $conexion->consultas($query);
            while($resultado = $conexion->devolverFilas()){
                if($resultado["nombre"] == "Entrantes"){
                    echo '<li>
                        <div style="margin-right: 25px">
                            <a onclick="validarTipo('.$resultado["id_tipo_producto"]. ');" data-toggle="tab"><img src="../imagenes/tipo_producto/cheese.png" style="width: 60px;"> ' .$resultado["nombre"].'</a>
                        </div>
                      </li>';
                }else if($resultado["nombre"] == "Ensaladas"){
                    echo '<li>
                        <div style="margin-right: 25px">
                            <a onclick="validarTipo('.$resultado["id_tipo_producto"]. ');" data-toggle="tab"><img src="../imagenes/tipo_producto/salad.png" style="width: 60px;"> ' .$resultado["nombre"].'</a>
                        </div>
                      </li>';
                }else if($resultado["nombre"] == "Carnes"){
                    echo '<li>
                        <div style="margin-right: 25px">
                            
                            <a onclick="validarTipo('.$resultado["id_tipo_producto"]. ');" data-toggle="tab"><img src="../imagenes/tipo_producto/meat.png" style="width: 60px;"> ' .$resultado["nombre"].'</a>
                        </div>
                      </li>';
                }else if($resultado["nombre"] == "Pescados"){
                    echo '<li>
                        <div style="margin-right: 25px">
                            <a onclick="validarTipo('.$resultado["id_tipo_producto"]. ');" data-toggle="tab"><img src="../imagenes/tipo_producto/salmon.png" style="width: 60px;"> ' .$resultado["nombre"].'</a>
                        </div>
                      </li>';
                }else if($resultado["nombre"] == "Bebidas"){
                    echo '<li>
                        <div style="margin-right: 25px">
                            <a onclick="validarTipo('.$resultado["id_tipo_producto"]. ');" data-toggle="tab"><img src="../imagenes/tipo_producto/cocktail.png" style="width: 60px;"> ' .$resultado["nombre"].'</a>
                        </div>
                      </li>';
                }else if($resultado["nombre"] == "Postres"){
                    echo '<li>
                        <div style="margin-right: 25px">
                            <a onclick="validarTipo('.$resultado["id_tipo_producto"]. ');" data-toggle="tab"><img src="../imagenes/tipo_producto/ice-cream-1.png" style="width: 60px;"> ' .$resultado["nombre"].'</a>
                        </div>
                      </li>';
                }
            }*/?>
        </ul>
        <div class="tab-content clearfix" id="contenidoProductos">
            <div class="tab-pane active" id="productos">

            </div>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </div>-->

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
