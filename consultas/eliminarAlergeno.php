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
echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Alergeno eliminado</span>
    <script>
        setTimeout(function(){
            $("#cuerpo").load("listadoAlergenos.php");
        }, 1200);
    </script>';
