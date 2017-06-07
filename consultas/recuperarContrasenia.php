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
        echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Contraseña modificada</span>
            <script>
                setTimeout(function(){
                    window.location="../paginas/inicioSesion.php ";
                }, 2000);
            </script>';
    }else{
        echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Ha ocurrido algún error. Vuelve a intentarlo</span>';
    }
}else{
    echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Error. Las contrasñas no coinciden</span>';
}

