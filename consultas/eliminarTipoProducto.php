<?php
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();
$query = "UPDATE tipo_producto SET is_delete = '1' WHERE id_tipo_producto = '".$_POST["id"]."'";
$conexion->consultas($query);

echo '
<script>
    $.growl.notice({ message: "Eliminado con exito" });
    $("#cuerpo").load("listadoTiposProductos.php");
</script>';

