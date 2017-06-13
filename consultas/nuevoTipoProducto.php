<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "INSERT INTO tipo_producto VALUES('','".$_POST["nombre"]."', 'NULL', 0) ";
$conexion->consultas($query);

if($conexion->filasAfectadas() > 0){
    echo '
            <script>
                $.growl.notice({ message: "Tipo de producto añadido" });
                setTimeout(function(){
                    $("#cuerpo").load("listadoTiposProductos.php");
                }, 2000);
            </script>';
}else{
    echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';
}
