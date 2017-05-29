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
        </script>
        <span class="col-md-12 alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Ese usuario ya existe</span>';
    }else{
        /*Si el usuario no existe, comprobamos que las dos contraseñas introducidas coincidan*/
        $contrasenia = $_POST['contrasenia'];
        $validarContrasenia = $_POST['contrasenia2'];
        if($contrasenia !== $validarContrasenia){
            echo '
            <script>
                $("#boton").css({"margin-top": "20px", "margin-right": "20px"});
            </script>
            <span class="col-md-12 alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Las contraseñas no coinciden</span>';
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

            echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Resgistro Completado</span>
            <script>
                setTimeout(function(){
                    window.location="../paginas/inicioSesion.php ";
                }, 1200);
            </script>';

        }
    }
}
//echo '<span class="col-md-12 alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"> Ha ocurrido un error al registrarse. Intentelo de nuevo</p>';