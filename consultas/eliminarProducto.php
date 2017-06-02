<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE producto SET is_delete = '1' WHERE id_producto = ?";
$sentencia = $conexion->cosultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_GET["id_producto"];
$sentencia->execute();
$sentencia->close();

//No estoy seguro de que esto funcione
echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Producto eliminado</span>
    <script>
        setTimeout(function(){
            $("#cuerpo").load("listadoProductos.php");
        }, 1200);
    </script>';

