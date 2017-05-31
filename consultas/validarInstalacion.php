<?php

if($_POST["contrasenia"] !== $_POST["repetirContrasenia"]){
    echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Error. Las contrasñas no coinciden</span>';
}else {

    $db = new PDO("localhost", "root", "");
    $sql = file_get_contents('../baseDatos/script.sql');


    $passwordEncrypted = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT);
    $query = "INSERT INTO `administrador` (`usuario`, `contrasenia`) VALUES (".$_POST["usuario"].", ".$passwordEncrypted." )";
    $db->query($query);

    if(!$db->exec($sql)){
        echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Ha ocurrido algún error. Vuelve a intentarlo</span>';
    }else{
        //Si la ejecución del archivo sql no ha dado ningun problema se le manda al usuario un correo con los datos de la cuenta del administrador.
        //Configuramos el correo que se le envia al usuario al realizar la reserva
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
    }
}