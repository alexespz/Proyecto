<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../procedimientos/carrito.php';

$carrito = new Carrito();
$conexion = new procedimientos();
$conexion->conect();

?>
<script>
    function visualizarPedido(){
        window.location = "../paginas/visualizarPedido.php";
    }

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
<?php

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
<table class="table table-striped col-md-10">
    <tr>
        <td class="col-md-7">Producto</td>
        <td class="col-md-1">Cantidad</td>
        <td class="col-md-1">Precio</td>
        <td class="col-md-1">Acciones</td>
    </tr>';
$carro = $carrito->get_content();
foreach($carro as $producto) {echo'
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
<button class="btn btn-warning" onclick="realizarPedido('.$carrito->precio_total().');">Realizar Pedido</button>';