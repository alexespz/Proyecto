<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE producto SET delete = 'true' WHERE id_producto = ?";
$sentencia = $conexion->cosultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_POST["id"];
$sentencia->execute();
$sentencia->close();

//No estoy seguro de que esto funcione
echo '
<script>
  $('#cuerpo').load("listadoProductos.php");
</script>';