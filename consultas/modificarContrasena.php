<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if($_POST["nuevaContrasena"] != $_POST["repetirContrasena"]){
    echo '<script>$.growl.error({ message: "Las contraseñas no coinciden" });</script>';
}else{
    $passEncrypted = password_hash($_POST["nuevaContrasena"], PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET contrasenia = '".$passEncrypted."' WHERE usuario = '".$_SESSION["usuario"]."'";
    $conexion->consultas($sql);
    if($conexion->filasAfectadas() > 0){
        echo '
            <script>
                $.growl.notice({ message: "Contraseña modificada" });
                setTimeout(function(){
                    $("#cuerpo").load("consultarPerfil.php");
                }, 2000);
            </script>';
    }
}