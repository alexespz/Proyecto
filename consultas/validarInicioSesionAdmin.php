<?php
session_start();
require_once '../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conexion->conect();

$query = "SELECT usuario, contrasenia FROM administrador WHERE usuario = ?";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bind_param('s', $user);
$user = $_POST['usuario'];
$sentencia->execute();
$sentencia->bind_result($usuario, $pass);
$sentencia->fetch();
$sentencia->close();

if(password_verify($_POST['contrasenia'], $pass)){
    $_SESSION['usuario'] = $usuario;
    echo '<script>window.location="../admin/menuAdmin.php";</script>';
}else{
    echo '
    <script>
        $("#usuario").attr("class", "bg-danger");
        $("#pass").attr("class", "bg-danger");
        $("#mensaje").fadeIn("slow","linear");
        $("#boton").css({"margin-top": "20px", "margin-right": "20px"});
        
        $.growl.error({ message: "El usuario y/o contraseña son incorrectos, vuelva a intentarlo." });
    </script>';
}
