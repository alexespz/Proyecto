<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$tipo = $_POST["tipo"];

$query = "SELECT * FROM tipo_producto WHERE id_tipo_producto '" .$_POST["id"]."' ";
$conexion->consultas($query);
$resultado = $conexion->devolverFilas();

if ($_POST["tipo"] == " ") {
    $tipo = $resultado["nombre"];
}

$query = "SELECT nombre FROM tipo_producto WHERE nombre = '".$_POST["tipo"]."' ";
$conexion->consultas($query);

if($conexion->devolverFilas() > 0){
    echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Ya existe ese tipo de producto</span>';
}else{
    $query = "UPDATE tipo_producto SET nombre = '".$tipo."' WHERE id_hora = '".$_POST["id"]."' ";
    $conexion->consultas($query);
    if($conexion->devolverFilas() > 0){
        echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Tipo de producto modificado</span>
        <script>
            setTimeout(function(){
                $("#cuerpo").load("listadoTiposProductos.php");
            }, 1200);
        </script>';
    }else{
        echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Se ha producido un error. Vuelva a intentarlo</span>';
    }
}
