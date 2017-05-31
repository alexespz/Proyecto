<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE hora_reserva SET is_delete = '1' WHERE id_hora = ?";
$sentencia = $conexion->cosultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_GET["id_hora"];
$sentencia->execute();
$sentencia->close();

//No estoy seguro de que esto funcione
echo '
<script>
  $("#cuerpo").load("listadoHoras.php");
</script>';
