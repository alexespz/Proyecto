<?php
include_once "../procedimientos/procedimientos.php";

$conexion = new procedimientos();
$conexion->conect();
$query = "DELETE FROM usuarios WHERE id_usuario = '".$_POST["id"]."' ";
$conexion->consultas($query);

echo '
<script>
    $("#cuerpo").load("listadoUsuarios.php");
</script>';