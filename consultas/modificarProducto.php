<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "SELECT * FROM producto WHERE id_producto = '" .$_POST["id"]."' ";
$conexion->consultas($query);
$resultado = $conexion->devolverFilas();

if ($_POST["nombre"] == "") {
    $_POST["nombre"] = $resultado["nombre"];
}

if ($_POST["descripcion"] == "") {
    $_POST["descripcion"] = $resultado["descripcion"];
}

if ($_POST["precio"] == "") {
    $_POST["precio"] = $resultado["precio"];
}

if ($_POST["foto"] == "") {
    $_POST["foto"] = 'NULL';
}

if ($_POST["calorias"] == "") {
    $_POST["calorias"] = $resultado["calorias"];
}

if ($_POST["tipo"] == "") {
    $_POST["tipo"] = $resultado["tipo"];
}
echo $_POST["foto"];
$foto = explode("\\", $_POST["foto"]);

$query = "UPDATE producto SET nombre = '".$_POST["nombre"]."', descripcion = '".$_POST["descripcion"]."', precio = ".$_POST["precio"].", foto = '".$_POST["foto"]."', calorias = '".$_POST["calorias"]."', tipo_producto = '".$_POST["tipo"]."' WHERE id_producto = '".$_POST["id"]."' ";
$conexion->consultas($query);

if($conexion->filasAfectadas() > 0){
    echo '
    <script>
        $.growl.notice({ message: "Producto modificado" });
        setTimeout(function(){
            $("#cuerpo").load("listadoProductos.php");
        }, 1200);
    </script>';
}else{
    echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';

}

