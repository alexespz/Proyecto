<?php
include_once '../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conexion->conect();
$indice = 0;

$obtenerProductos = "SELECT nombre,precio FROM producto WHERE id_producto = ?";
$sentenciaProductos = $conexion->consultasPreparadas($obtenerProductos);
$sentenciaProductos->bind_Param('i', $id);
$id = $_POST["id"];
$sentenciaProductos->execute();
$sentenciaProductos->bind_result($nombre, $precio);
$sentenciaProductos->fetch();
$sentenciaProductos->close();

$carrito = array("producto".$indice=> $nombre, "precio".$indice=> $precio);
$indice += 1;

for($i=0; $i< count($carrito); $i++){
    echo '<span>'.$carrito[$i]['producto'].'</span>
        <script>
        $("#columnaPrecio").html("'.$carrito[$i]['precio'].' €");
        </script>';
}
