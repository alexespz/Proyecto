<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../procedimientos/carrito.php';

$carrito = new Carrito();
$conexion = new procedimientos();
$conexion->conect();

$obtenerProductos = "SELECT id_producto, nombre, precio FROM producto WHERE id_producto = ?";
$sentenciaProductos = $conexion->consultasPreparadas($obtenerProductos);
$sentenciaProductos->bind_Param('i', $id);
$id = $_POST["id"];
$sentenciaProductos->execute();
$sentenciaProductos->bind_result($id, $nombre, $precio);
$sentenciaProductos->fetch();

$articulo = array("id"=>$id , "nombre"=>"$nombre", "precio"=>$precio, "cantidad"=>1);
$carrito->add($articulo);

echo '
<table class="table table-striped col-md-9">
    <tr>
        <td class="col-md-7">Producto</td>
        <td class="col-md-1">Cantidad</td>
        <td class="col-md-1">Precio</td>
    </tr>';
$carro = $carrito->get_content();
foreach($carro as $producto) {echo'
    <tr>
        <td class="col-md-7">'.$producto["nombre"].'</td>
        <td class="col-md-1">'.$producto["cantidad"].'</td>
        <td class="col-md-1">'.$producto["precio"].' €</td>
    </tr>';
}echo '
</table>
<p class="bg-success">Total: '.$carrito->precio_total().' €</p>
<button class="btn btn-default" href="../consultar/visualizarPedido.php">Ver pedido</button>
<hr/>
<button class="btn btn-warning" href="../consultas/realizarPedido.php?total='.$carrito->precio_total().'">Realizar Pedido</button>';