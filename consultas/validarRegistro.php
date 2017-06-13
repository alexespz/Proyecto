<?php
session_start();
require_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_POST['submit'])){
    echo "Acceso prohibido";
}else{
    /*Comprobamos en primer lugar si existe ya un usuario registrado con el nombre que recibimos*/
    $query = "SELECT usuario FROM usuarios WHERE usuario = ?";
    $sentencia = $conexion->consultasPreparadas($query);
    $sentencia->bind_param('s', $user);
    $user = $_POST['usuario'];
    $sentencia->execute();
    $sentencia->bind_result($usuario);
    $sentencia->fetch();
    $sentencia->close();
    if($usuario == $_POST["usuario"]){
        echo '
        <script>
            $("#boton").attr("class", "espacios");
            $.growl.error({ message: "Ya existe un usuario con ese nombre" });
        </script>';
    }else{
        /*Si el usuario no existe, comprobamos que las dos contraseñas introducidas coincidan*/
        $contrasenia = $_POST['contrasenia'];
        $validarContrasenia = $_POST['contrasenia2'];
        if($contrasenia !== $validarContrasenia){
            echo '
            <script>
                $("#boton").css({"margin-top": "20px", "margin-right": "20px"});
                $.growl.error({ message: "Las contraseñas no coinciden" });
            </script>';
        }else{
            /*Una vez comprobado que todos los campos estan rellenos, que el usuario no exista y las contraseñas coinciden. Introducimos al usuario en la base de datos*/
            $sexo = '';
            if($_POST["sexo"] === 'Hombre'){
                $sexo = 'H';
            }else{
                $sexo = 'M';
            }

            $passEncrypted = password_hash($contrasenia, PASSWORD_DEFAULT);
            $insert = "INSERT INTO usuarios VALUES('', '".$_POST["nombre"]."', '".$_POST["apellidos"]."', '".$_POST["dni"]."', '".$_POST["telefono"]."', '".$sexo."', '".$user."', '".$passEncrypted."', '".$_POST["email"]."', '');";
            $conexion->consultas($insert);

            echo '
            <script>
                $.growl.error({ message: "Registro completado" });
                setTimeout(function(){
                    window.location="../paginas/inicioSesion.php ";
                }, 2000);
            </script>';

        }
    }
}