<?php
session_start();
include_once '../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["carrito"])){
    $_SESSION["carrito"] = array();
    $ref = 1;
}else{
    end($_SESSION["carrito"]);
    $ref = key($_SESSION["carrito"]);
    $ref += 1;
}

$obtenerProductos = "SELECT id_producto, nombre, precio FROM producto WHERE id_producto = ?";
$sentenciaProductos = $conexion->consultasPreparadas($obtenerProductos);
$sentenciaProductos->bind_Param('i', $id);
$id = $_POST["id"];
$sentenciaProductos->execute();
$sentenciaProductos->bind_result($id, $nombre, $precio);
$sentenciaProductos->fetch();

foreach ($_SESSION["carrito"] as $producto){
    if($producto["nombre"] == $nombre){
        $producto["cantidad"] += 1;
    }
}
$carrito[$ref]=array("idProducto"=>$id , "nombre"=>$nombre, "precio"=>$precio, "cantidad"=>1 ,"ref"=>$ref);
$_SESSION["carrito"] += $carrito;
echo '
<table class="table table-striped col-md-9">
    <tr>
        <td class="col-md-7">Producto</td>
        <td class="col-md-1">Cantidad</td>
        <td class="col-md-1">Precio</td>
    </tr>';
foreach ($_SESSION["carrito"] as $producto){echo'
    <tr>
        <td class="col-md-7">'.$producto["nombre"].'</td>
        <td class="col-md-1">'.$producto["cantidad"].'</td>
        <td class="col-md-1">'.$producto["precio"].' €</td>
    </tr>';
    $total += ($producto["precio"] * $producto["cantidad"]);
}echo '
</table>
<td class="col-md-3"><button class="btn btn-success" >Total: '.$total.'</button></td>
<td class="col-md-1"><button class="btn btn-warning" href="../consultas/realizarPedido.php?total='.$total.'">Realizar Pedido</button></td>';
