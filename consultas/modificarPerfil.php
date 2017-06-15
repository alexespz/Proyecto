<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../consultas/obtenerPerfil.php';
$conexion = new procedimientos();
$conexion->conect();

$sql = "SELECT nombre, apellidos, email, telefono, dni FROM usuarios WHERE dni = '".$_POST["dni"]."' OR telefono = '".$_POST["telefono"]."' OR email = '".$_POST["email"]."'";
$conexion->consultas($sql);
if($conexion->devolverFilas() > 0){
    echo '<script>$.growl.error({ message: "El correo, telefono o dni especificado ya existen" });</script>';
}else {
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ".$_SESSION["idUsuario"]." ";

    $conexion->consultas($sql);
    $resultado = $conexion->devolverFilas();

    if ($_POST["nombre"] == "") {
        $_POST["nombre"] = $resultado["nombre"];
    }

    if ($_POST["apellidos"] == "") {
        $_POST["apellidos"] = $resultado["apellidos"];
    }

    if ($_POST["email"] == "") {
        $_POST["email"] = $resultado["email"];
    }

    if ($_POST["telefono"] == "") {
        $_POST["telefono"] = $resultado["telefono"];
    }

    if ($_POST["sexo"] == "") {
        $_POST["sexo"] = $resultado["sexo"];
    }

    if ($_POST["dni"] == "") {
        $_POST["dni"] = $resultado["dni"];
    }

    $sql = "UPDATE usuarios SET nombre = '" . $_POST["nombre"] . "', apellidos = '" . $_POST["apellidos"] . "', email = '" . $_POST["email"] . "', telefono = '" . $_POST["telefono"] . "', sexo = '" . $_POST["sexo"] . "', dni = '" . $_POST["dni"] . "'  WHERE usuario = '" . $_SESSION["usuario"] . "'";
    $conexion->consultas($sql);
    $_SESSION['nombre'] = $_POST["nombre"];
    $_SESSION['email'] = $_POST["email"];
    if ($conexion->filasAfectadas() > 0) {
        echo '
        <script>
            $.growl.notice({ message: "Usuario modificado" });
            setTimeout(function(){
                $("#cuerpo").load("consultarPerfil.php");
            }, 1200);
        </script>';
    } else {
        echo '<script>$.growl.error({ message: "Ha ocurrido algún error al modificar los datos. Vuelva a intentarlo" });</script>';
    }
}
