<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

//Creamos el codigo de pedido aleatorio
$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$codigo = array();
$longitud = strlen($alphabet) - 1;
for ($i = 0; $i < 9; $i++) {
    $cod = rand(0, $longitud);
    $codigo[] = $alphabet[$cod];
}
$codigoPedido = implode($codigo); //devolvemos el array convertido a string

$query = "INSERT INTO pedido(id_usuario, precio, codigo_pedido) VALUES (?,?,?)";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bind_param('iis', $idUsuario, $precio, $codigoPe);
$idUsuario = $_SESSION["usuario"];
$precio = $_GET["total"];
$codigoPe = $codigoPedido;
$sentencia->execute();
$sentencia->bind_result($idUsuario, $precio, $codigoPe);
$sentencia->close();

$lastId = $conexion->ultimoId();
foreach ($_SESSION["carrito"] as $producto){
    $query .= "INSERT INTO pedido_producto VALUES(".$lastId.", ".$producto["id"].", ".$producto["cantidad"].")";
}
$conexion->multiConsultas($query);