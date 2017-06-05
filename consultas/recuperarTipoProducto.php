<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE tipo_producto SET is_delete = '0' WHERE id_tipo_producto = ?";
$sentencia = $conexion->cosultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_GET["id"];
$sentencia->execute();
$sentencia->close();

echo '
    <script>
        $("#cuerpo").load("listadoTiposProducto.php");
    </script>';