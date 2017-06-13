<?php
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE hora_reserva SET is_delete = '1' WHERE id_hora = ?";
$sentencia = $conexion->consultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_POST["id"];
$sentencia->execute();
$sentencia->close();

echo '
<script>
    $.growl.notice({ message: "Eliminado con exito" });
    $("#cuerpo").load("listadoHoras.php");
</script>';
