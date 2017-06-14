<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../procedimientos/carrito.php';

$carrito = new Carrito();
$conexion = new procedimientos();
$conexion->conect();

$carrito->remove_producto($_POST["id"]);

$carro = $carrito->get_content();
if($carro == null) {
    echo 'No hay productos en el carrito';
}else{echo'
    <table class="table table-striped col-md-10">
    <tr>
        <td class="col-md-7">Producto</td>
        <td class="col-md-1">Cantidad</td>
        <td class="col-md-1">Precio</td>
        <td class="col-md-1">Acciones</td>
    </tr>';
    $carro = $carrito->get_content();
    foreach($carro as $producto){echo'
        <tr>
            <td class="col-md-7">'.$producto["nombre"].'</td>
            <td class="col-md-1">'.$producto["cantidad"].'</td>
            <td class="col-md-1">'.$producto["precio"].' €</td>
            <td class="col-md-1"><button type="button" class="btn btn-danger" onclick="eliminarProducto('.$producto["id"].')"><span class="glyphicon glyphicon-remove"></span></button></td>
        </tr>';
    }echo '
    </table>
    <p>Total: '.$carrito->precio_total().' €</p>
    <hr/>
    <button type="button" class="btn btn-warning" onclick="realizarPedido('.$carrito->precio_total().');">Realizar Pedido</button>';
}

echo '
<script>
    $.growl.notice({ message: "Producto eliminado" });
    
</script>';