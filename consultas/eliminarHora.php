<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "UPDATE hora_reserva SET is_delete = '1' WHERE id_hora = ?";
$sentencia = $conexion->cosultasPreparadas();
$sentencia->bind_param('i', $id);
$id = $_GET["id_hora"];
$sentencia->execute();
$sentencia->close();

//No estoy seguro de que esto funcione
echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Hora eliminada</span>
    <script>
        setTimeout(function(){
            $("#cuerpo").load("listadoHoras.php");
        }, 1200);
    </script>';
