<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();
$tipo = $_POST["tipo"];

$query = "SELECT * FROM tipo_producto WHERE id_tipo_producto = '" .$_POST["id"]."' ";
$conexion->consultas($query);
$resultado = $conexion->devolverFilas();

if ($_POST["tipo"] == "") {
    $tipo = $resultado["nombre"];
}

$query = "SELECT nombre FROM tipo_producto WHERE nombre = '".$_POST["tipo"]."' ";
$conexion->consultas($query);

if($conexion->filasAfectadas() > 0){
    echo '<script>$.growl.error({ message: "Ya existe ese tipo de producto" });</script>';
}else{
    $query = "UPDATE tipo_producto SET nombre = '".$tipo."' WHERE id_tipo_producto = '".$_POST["id"]."' ";
    $conexion->consultas($query);
    if($conexion->filasAfectadas() > 0){
        echo '
        <script>
            $.growl.notice({ message: "Tipo de producto modificado" });
            setTimeout(function(){
                $("#cuerpo").load("listadoTiposProductos.php");
            }, 2000);
        </script>';
    }else{
        echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';
    }
}
