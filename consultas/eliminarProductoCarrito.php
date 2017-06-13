<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../procedimientos/carrito.php';

$carrito = new Carrito();
$conexion = new procedimientos();
$conexion->conect();

$carrito->remove_producto($_POST["id"]);

echo '
<script>
    $.growl.notice({ message: "Producto eliminado" });
    $("#resultado").load("visualizarPedido.php");
</script>';