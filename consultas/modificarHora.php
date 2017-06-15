<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();
$hora = $_POST["hora"];

$query = "SELECT * FROM hora_reserva WHERE id_hora = '" .$_POST["id"]."' ";
$conexion->consultas($query);
$resultado = $conexion->devolverFilas();

if ($_POST["hora"] == "") {
    $hora = $resultado["hora"];
}

$query = "SELECT hora FROM hora_reserva WHERE hora = '".$hora."' ";
$conexion->consultas($query);

if($conexion->filasAfectadas() > 0){
    echo '<script>$.growl.error({ message: "Ya existe la hora especificada" });</script>';
}else{
    $query = "UPDATE hora_reserva SET hora = '".$hora."' WHERE id_hora = '".$_POST["id"]."' ";
    echo $query;
    $conexion->consultas($query);
    if($conexion->filasAfectadas() > 0){
        echo '
        <script>
            $.growl.notice({ message: "Hora modificada con exito" });
            setTimeout(function(){
                $("#cuerpo").load("listadoHoras.php");
            }, 2000);
        </script>';
    }else{
        echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelve a intentarlo" });</script>';
    }
}
