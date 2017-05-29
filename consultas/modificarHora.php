<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "SELECT hora FROM hora_reserva WHERE id_hora = '".$_POST["id"]."' ";
$conexion->consultas($query);
if($conexion->devolverFilas() > 0){
    echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> La hora especificada ya existe</span>';
}else{
    $query = "UPDATE hora_reserva SET hora = '".$_POST["hora"]."' WHERE id_hora = '".$_POST["id"]."' ";
    $conexion->consultas($query);
    if($conexion->devolverFilas() > 0){
        echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Modificado correctamente</span>
        <script>
            setTimeout(function(){
                $("#cuerpo").load("listadoHoras.php");
            }, 1200);
        </script>';
    }else{
        echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Se ha producido un error. Vuelva a intentarlo</span>';
    }
}
