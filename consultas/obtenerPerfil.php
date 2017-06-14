<?php
$conexion = new procedimientos();
$conexion->conect();

$sql = "SELECT nombre, apellidos, dni, telefono, sexo, email, usuario FROM usuarios WHERE usuario = ?";
$sentencia = $conexion->consultasPreparadas($sql);
$sentencia->bind_param('s', $usuario);
$usuario = $_SESSION["usuario"];
$sentencia->execute();
$sentencia->bind_result($nombre, $apellidos, $dni, $telefono, $sexo, $email, $usuario);
$sentencia->fetch();
$sentencia->close();
