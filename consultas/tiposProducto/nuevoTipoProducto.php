<?php
session_start();
include_once '../../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "INSERT INTO tipo_producto VALUES('','".$_POST["nombre"]."') ";
$conexion->consultas($query);

if($conexion->devolverFilas() > 0){
    echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Tipo de producto añadido</span>
            <script>
                setTimeout(function(){
                    $("#cuerpo").load("listadoTiposProductos.php");
                }, 1200);
            </script>';
}else{
    echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Se ha producido un error. Vuelva a intentarlo</span>';
}
