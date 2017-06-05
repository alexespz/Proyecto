<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE producto SET is_delete = '0' WHERE id_producto = ?";
$sentencia = $conexion->cosultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_GET["id"];
$sentencia->execute();
$sentencia->close();

echo '
    <script>
        $("#cuerpo").load("listadoProductos.php");
    </script>';