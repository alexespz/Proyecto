<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();
$alergeno = $_POST["nombre"];

$query = "SELECT * FROM alergeno WHERE id_alergeno = '" .$_POST["id"]."' ";
$conexion->consultas($query);
$resultado = $conexion->devolverFilas();

if ($_POST["nombre"] == "") {
    $alergeno = $resultado["nombre"];
}

$query = "SELECT nombre FROM alergeno WHERE nombre = '".$alergeno."' ";
$conexion->consultas($query);

if($conexion->filasAfectadas() > 0){
    echo '<script>$.growl.error({ message: "Ya existe un alergeno con ese nombre" });</script>';
}else{
    $query = "UPDATE alergeno SET nombre = '".$alergeno."' WHERE id_alergeno = '".$_POST["id"]."' ";
    $conexion->consultas($query);
    if($conexion->filasAfectadas() > 0){
        echo '
        <script>
            $.growl.notice({ message: "Alergeno modificado" });
            setTimeout(function(){
                $("#cuerpo").load("listadoAlergenos.php");
            }, 2000);
        </script>';
    }else{
        echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';
    }
}
