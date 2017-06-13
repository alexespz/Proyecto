<?php
session_start();
include_once '../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conexion->conect();

$sql = "SELECT usuario FROM usuarios WHERE usuario = '".$_POST["usuarioNuevo"]."'";
$conexion->consultas($sql);
if($conexion->filasAfectadas() > 0){
    echo '<script>$.growl.error({ message: "Ese nombre de usuario ya existe" });</script>';
}else{
    $sql = "UPDATE usuarios SET usuario = '".$_POST["usuarioNuevo"]."' WHERE usuario = '".$_POST["usuarioAntiguo"]."'";
    $conexion->consultas($sql);
    $_SESSION["usuario"] = $_POST["usuarioNuevo"];
    if($conexion->filasAfectadas() > 0){
        echo '
            <script>
                $.growl.notice({ message: "Usuario modificado" });
                setTimeout(function(){
                    $("#cuerpo").load("consultarPerfil.php");
                }, 2000);
            </script>';
    }else {
        echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';
    }
}
