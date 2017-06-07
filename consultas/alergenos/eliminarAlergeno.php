<?php
session_start();
include_once '../../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE alergeno SET is_delete = '1' WHERE id_alergeno = ?";
$sentencia = $conexion->cosultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_POST["id"];
$sentencia->execute();
$sentencia->close();

echo '
    <script>
        $("#cuerpo").load("listadoAlergenos.php");
    </script>';
