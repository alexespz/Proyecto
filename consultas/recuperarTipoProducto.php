<?php
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE tipo_producto SET is_delete = '0' WHERE id_tipo_producto = ?";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bind_param('i', $id);
$id = $_POST["id"];
$sentencia->execute();
$sentencia->close();

echo '
    <script>
        $("#cuerpo").load("listadoTiposProductos.php");
    </script>';