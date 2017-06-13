<?php
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if($_POST["contrasenia"] == $_POST["repetirContrasenia"]){
    $query = "UPDATE usuarios SET contrasenia = ? WHERE email = ?";
    $sentencia = $conexion->consultasPreparadas($query);
    $sentencia->bind_param('ss', $pass, $correo);
    $pass = $_POST["contrasenia"];
    $correo = $_POST["email"];
    $sentencia->execute();

    if($sentencia->affected_rows > 0){
        echo '
            <script>
                $.growl.notice({ message: "Contraseña modificada" });
                setTimeout(function(){
                    window.location="../paginas/inicioSesion.php ";
                }, 2000);
            </script>';
    }else{
        echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';
    }
}else{
    echo '<script>$.growl.error({ message: "Las contraseñas no coinciden" });</script>';
}

