<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();
$hora = explode(" ", $_POST["hora"]);
$query = "SELECT hora FROM hora_reserva WHERE hora = '".$hora."' ";
$conexion->consultas($query);

if($conexion->filasAfectadas() > 0){
    echo '<script>$.growl.error({ message: "Ya existe la hora especificada" });</script>';
}else {
    $query = "INSERT INTO hora_reserva VALUES('','".$hora."', 0) ";
    $conexion->consultas($query);

    if($conexion->filasAfectadas() > 0){
        echo '
            <script>
                $.growl.notice({ message: "Hora añadida" });
                setTimeout(function(){
                    $("#cuerpo").load("listadoHoras.php");
                }, 2000);
            </script>';
    }else{
        echo '<script>$.growl.error({ message: "Se ha prducido un erro. Vuelve a intentarlo" });</script>';
    }
}