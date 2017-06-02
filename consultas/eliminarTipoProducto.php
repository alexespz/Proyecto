<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE tipo_producto SET is_delete = '1' WHERE id_tipo_producto = ?";
$sentencia = $conexion->cosultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_GET["id_tipo_producto"];
$sentencia->execute();
$sentencia->close();

//No estoy seguro de que esto funcione
echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Tipo de producto eliminado</span>
    <script>
        setTimeout(function(){
            $("#cuerpo").load("listadoTiposProducto.php");
        }, 1200);
    </script>';

