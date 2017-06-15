<?php
include_once "../procedimientos/procedimientos.php";

$conexion = new procedimientos();
$conexion->conect();
$query = "DELETE FROM usuarios WHERE id_usuario = '".$_POST["id"]."' ";
echo $query;
$conexion->consultas($query);

echo '
<script>
    $.growl.notice({ message: "Eliminado con exito" });
    $("#cuerpo").load("listadoUsuarios.php");
</script>';
