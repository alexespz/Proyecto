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

$obtenerProductos = "SELECT nombre,precio FROM producto WHERE id_producto = ?";
$sentenciaProductos = $conexion->consultasPreparadas($obtenerProductos);
$sentenciaProductos->bind_Param('i', $id);
$id = $_POST["id"];
$sentenciaProductos->execute();
$sentenciaProductos->bind_result($nombre, $precio);
$sentenciaProductos->fetch();

$carrito[$ref]=array("nombre"=>"$nombre", "precio"=>$precio, "ref"=>$ref);
$_SESSION["carrito"] += $carrito;
echo '
<table class="table table-striped col-md-8">
    <tr>
        <td class="col-md-7">Producto</td>
        <td class="col-md-1">Precio</td>
    </tr>';
foreach ($_SESSION["carrito"] as $producto){echo'
    <tr>
        <td class="col-md-7">'.$producto["nombre"].'</td>
        <td class="col-md-1">'.$producto["precio"].' €</td>
    </tr>';
}echo '
</table>
<td class="col-md-1"><button class="btn btn-warning" href="../consultas/realizarPedido.php">Realizar Pedido</button></td>';
