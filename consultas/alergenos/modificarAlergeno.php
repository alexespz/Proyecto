<?php
session_start();
include_once '../../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$alergeno = $_POST["nombre"];

$query = "SELECT * FROM alergeno WHERE id_alergeno '" .$_POST["id"]."' ";
$conexion->consultas($query);
$resultado = $conexion->devolverFilas();

if ($_POST["nombre"] == " ") {
    $alergeno = $resultado["nombre"];
}

$query = "SELECT nombre FROM alergeno WHERE nombre = ? ";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bind_param("s", $nombreAlergeno);
$nombreAlergeno = $_POST["nombre"];
$sentencia->execute();
$sentencia->bind_result($nombre);
$sentencia->close();

if($conexion->devolverFilas() > 0){
    echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Ya existe un alergeno con ese nombre</span>';
}else{
    $query = "UPDATE alergeno SET nombre = '".$alergeno."' WHERE id_alergeno = '".$_POST["id"]."' ";
    $conexion->consultas($query);
    if($conexion->devolverFilas() > 0){
        echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Alergeno modificado</span>
        <script>
            setTimeout(function(){
                $("#cuerpo").load("listadoAlergenos.php");
            }, 1200);
        </script>';
    }else{
        echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Se ha producido un error. Vuelva a intentarlo</span>';
    }
}
