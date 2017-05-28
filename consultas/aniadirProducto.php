<?php
include_once '../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conexion->conect();
$carrito = [];
$indice = 0;

$obtenerProductos = "SELECT nombre,precio FROM producto WHERE id_producto = ?";
$sentenciaProductos = $conexion->consultasPreparadas($obtenerProductos);
$sentenciaProductos->bind_Param('i', $id);
$id = $_POST["id"];
$sentenciaProductos->execute();
$sentenciaProductos->bind_result($nombre, $precio);
$sentenciaProductos->fetch();

array_push($carrito, ["producto".$indice=> $nombre, "precio".$indice=> $precio]);
$indice += 1;

echo '
<table class="table table-striped col-md-8">
    <tr>
        <td class="col-md-7">Producto</td>
        <td class="col-md-1">Precio</td>
    </tr>';
for($i=0; $i< count($carrito); $i++){echo'
    <tr>
        <td class="col-md-7">'.$carrito[$i]["producto".$i.""].'</td>
        <td class="col-md-1">'.$carrito[$i]["precio".$i.""].' €</td>
    </tr>';
}echo '
</table>
<td class="col-md-1"><button class="btn btn-warning" href="../consultas/realizarPedido.php">Realizar Pedido</button></td>';
