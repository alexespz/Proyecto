<?php
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE hora_reserva SET is_delete = '0' WHERE id_hora = ?";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bind_param('i', $id);
$id = $_POST["id"];
$sentencia->execute();
$sentencia->close();

echo '
<script>
$.growl.notice({ message: "Se ha recuperado con exito" });
$("#cuerpo").load("listadoHoras.php");
</script>';