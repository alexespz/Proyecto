<?php
session_start();
include_once '../../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if($_POST["nuevaContrasena"] != $_POST["repetirContrasena"]){
    echo '<span class="col-md-12 alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Las contraseñas no coinciden</span>';
}else{
    $passEncrypted = password_hash($_POST["nuevaContrasena"], PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET contrasenia = '".$passEncrypted."' WHERE usuario = '".$_SESSION["usuario"]."'";
    $conexion->consultas($sql);
    if($conexion->filasAfectadas() > 0){
        echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Contraseña modificada</span>
            <script>
                setTimeout(function(){
                    $("#cuerpo").load("consultarPerfil.php");
                }, 1200);
            </script>';
    }
}