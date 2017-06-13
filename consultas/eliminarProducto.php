<?php
include_once "../procedimientos/procedimientos.php";

$conexion = new procedimientos();
$conexion->conect();
$query = "UPDATE producto SET is_delete = '1' WHERE id_producto = '".$_POST["id"]."' ";
$conexion->consultas($query);

echo '
<script>
    $.growl.notice({ message: "Eliminado con exito" });
    $("#cuerpo").load("listadoProductos.php");
</script>';
