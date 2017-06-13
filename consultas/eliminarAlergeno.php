<?php
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();
$query = "UPDATE alergeno SET is_delete = '1' WHERE id_alergeno = '".$_POST["id"]."' ";
$conexion->consultas($query);

echo '
<script>
    $.growl.notice({ message: "Eliminado con exito" });
    $("#cuerpo").load("listadoAlergenos.php");
</script>';
