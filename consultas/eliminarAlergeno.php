<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE alergenos SET is_delete = '1' WHERE id_alergeno = ?";
$sentencia = $conexion->cosultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_GET["id_alergeno"];
$sentencia->execute();
$sentencia->close();

//No estoy seguro de que esto funcione
echo '
<script>
  $("#cuerpo").load("listadoAlergenos.php");
</script>';