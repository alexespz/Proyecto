<?php
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if($_POST["contrasenia"] !== $_POST["repetirContrasenia"]){
    echo '<script>$.growl.error({ message: "Las contraseñas no coinciden" });</script>';
}else {

    $passwordEncrypted = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT);

    $sql = file_get_contents('../baseDatos/script.sql');
    $sql .= "INSERT INTO `administrador` (`usuario`, `contrasenia`) VALUES ('".$_POST["usuario"]."', '".$passwordEncrypted."' )";
    $conexion->multiConsultas($sql);

    if($conexion->filasAfectadas() > 0){
        //Si la ejecución del archivo sql no ha dado ningun problema se le manda al usuario un correo con los datos de la cuenta del administrador.
        $para      = $_POST["email"];
        $titulo    = 'Instalación Manducare';
        $mensaje   = 'Gracias por instalar Manducare. A continuación se muestran los datos para acceder con el usuario administrador:' ."\r\n";
        $mensaje .= '<h3> Usuario: '.$_POST["usuario"].'</h3>' ."\r\n";
        $mensaje .= '<h3> Contraseña: '.$_POST["contrasenia"].'</h3>' ."\r\n";
        $mensaje .= 'Para iniciar sesión como administrador deberá dirigirse a la siguiente URL: alejandroflores.ga/proyecto/admin';

        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Cabeceras adicionales
        $cabeceras .= 'From: webmaster@manducare.com' . "\r\n";

        mail($para, $titulo, $mensaje, $cabeceras);

        echo '
            <script>
                $.growl.notice({ message: "Se ha realizado la instalacion con exito. Le enviaremos los datos a su direccion de correo" });
                setTimeout(function(){
                    window.location="../paginas/inicioSesion.php ";
                }, 2000);
            </script>';
    }else{
        echo '<script>$.growl.error({ message: "Ha ocurrido algún error vuelve ha intentarlo" });</script>';
    }
}
