<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../consultas/obtenerPerfil.php';
$conexion = new procedimientos();
$conexion->conect();

/*$sql = "SELECT email,telefono,dni FROM usuarios WHERE dni = '".$_POST["dni"]."' OR telefono = '".$_POST["telefono"]."' OR email = '".$_POST["email"]."'";
$conexion->consultas($sql);
if($conexion->filasAfectadas() > 0){
    echo '<span class="col-md-12 alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> El correo, telefono o dni especificado ya existen</span>';
}else{*/
echo $_POST["nombre"];
/*if($_POST["nombre"] == ''){
    $_POST["nombre"] = $nombre;
}

if($_POST["apellidos"] == ''){
    $_POST["apellidos"] = $apellidos;
}

if($_POST["email"] == ''){
    $_POST["email"] = $email;
}

if($_POST["telefono"] == ''){
    $_POST["telefono"] = $telefono;
}

if($_POST["sexo"] == ''){
    $_POST["sexo"] = $sexo;
}

if($_POST["dni"] == ''){
    $_POST["dni"] = $dni;
}*/

$sql = "UPDATE usuarios SET nombre = '".$_POST["nombre"]."', apellidos = '".$_POST["apellidos"]."', email = '".$_POST["email"]."', telefono = '".$_POST["telefono"]."', sexo = '".$_POST["sexo"]."', dni = '".$_POST["dni"]."',  WHERE usuario = '".$_SESSION["usuario"]."'";
$conexion->consultas($sql);
$_SESSION['nombre'] = $_POST["nombre"];
$_SESSION['email'] = $_POST["email"];
if($conexion->filasAfectadas() > 0){
    echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Usuario modificado</span>
        <script>
            setTimeout(function(){
                $("#cuerpo").load("consultarPerfil.php");
            }, 1200);
        </script>';
}
