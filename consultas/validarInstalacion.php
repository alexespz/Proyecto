<?php
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if($_POST["contrasenia"] !== $_POST["repetirContrasenia"]){
    echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Error. Las contrasñas no coinciden</span>';
}else {

    $passwordEncrypted = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT);

    $sql = file_get_contents('../baseDatos/script.sql');
    $sql .= "INSERT INTO `administrador` (`usuario`, `contrasenia`) VALUES ('".$_POST["usuario"]."', '".$passwordEncrypted."' )";

    if(!$conexion->multiConsultas($sql)){
        echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Ha ocurrido algún error. Vuelve a intentarlo</span>';
    }else{
        //Si la ejecución del archivo sql no ha dado ningun problema se le manda al usuario un correo con los datos de la cuenta del administrador.
        $para      = $_POST["email"];
        $titulo    = 'Instalación de "nombre de la aplicación';
        $mensaje   = 'Gracias por instalar "nombre de la aplicación. A continuación se muestran los datos para acceder con el usuario administrador.'
            ."<h3> Usuario: ".$_POST["usuario"]."</h3><br/>
                      <h3> Contraseña: ".$_POST["contrasenia"]."</h3><br/>"
            .'Para iniciar sesión como administrador deberá dirigirse a la siguiente URL: alejandroflores.ga/proyecto/admin';
        $cabeceras = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($para, $titulo, $mensaje, $cabeceras);

        echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Se ha realizado la instalación con existo. Le enviaremos los datos a su direccion de correo</span>
            <script>
                setTimeout(function(){
                    window.location="../paginas/inicioSesion.php ";
                }, 2000);
            </script>';
    }
}
