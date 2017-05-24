<?php
session_start();
include_once '../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conexion->conect();

$sql = "SELECT usuario FROM usuarios WHERE usuario = '".$_POST["usuarioNuevo"]."'";
$conexion->consultas($sql);
if($conexion->filasAfectadas() > 0){
    echo '<span class="col-md-12 alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Ese nombre de usuario ya existe</span>';
}else{
    $sql = "UPDATE usuarios SET usuario = '".$_POST["usuarioNuevo"]."' WHERE usuario = '".$_POST["usuarioAntiguo"]."'";
    $conexion->consultas($sql);
    $_SESSION["usuario"] = $_POST["usuarioNuevo"];
    if($conexion->filasAfectadas() > 0){
        echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Usuario modificado</span>
            <script>
                setTimeout(function(){
                    $("#cuerpo").load("consultarPerfil.php");
                }, 1200);
            </script>';
    }
}
