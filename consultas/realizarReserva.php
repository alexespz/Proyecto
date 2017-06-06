<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$obtenerUsuario = "SELECT id_usuario, email FROM usuarios WHERE id_usuario = ?";
$sentencia = $conexion->consultasPreparadas($obtenerUsuario);
$sentencia->bind_param('i', $idUsuario);
$idUsuario = $_SESSION["idUsuario"];
$sentencia->execute();
$sentencia->bind_result($idUsuario, $email);
$sentencia->close();

//Creamos el codigo de reserva aleatorio
$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$codigo = array();
$longitud = strlen($alphabet) - 1;
for ($i = 0; $i < 9; $i++) {
    $cod = rand(0, $longitud);
    $codigo[] = $alphabet[$cod];
}
$codigoReserva = implode($codigo); //devolvemos el array convertido a string

$sql = "INSERT INTO reserva VALUES ('', ".$idUsuario.", ".$_POST["comensales"].", '".$_POST["fecha"]."', '".$_POST["hora"]."', '".$codigoReserva."')";
$conexion->consultas($sql);

//obtenemos el ultimo id insertado e introducimos los alergenos indicados en la reserva
$lastId = $conexion->ultimoId();
$query = "";
if($_POST["alergeno1"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 1);";
}

if($_POST["alergeno2"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 2);";
}

if($_POST["alergeno3"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 3);";
}

if($_POST["alergeno4"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 4);";
}

if($_POST["alergeno5"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 5);";
}

if($_POST["alergeno6"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 6);";
}

if($_POST["alergeno7"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 7);";
}

if($_POST["alergeno8"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 8);";
}

if($_POST["alergeno9"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 9);";
}

if($_POST["alergeno10"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 10);";
}

if($_POST["alergeno11"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 11);";
}

if($_POST["alergeno12"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 12);";
}

if($_POST["alergeno13"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 13);";
}

if($_POST["alergeno14"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES ('', ".$lastId.", 14);";
}

$conexion->multiConsultas($query);
if($conexion->filasAfectadas() > 0){
    //Configuramos el correo que se le envia al usuario al realizar la reserva
    $para      = $email;
    $titulo    = 'DATOS DE LA RESERVA';
    $mensaje   = 'Tu codigo de reserva es el siguiente: '.$codigoReserva;

    $cabeceras = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($para, $titulo, $mensaje, $cabeceras);

    echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Reserva Realizada. Le enviaremos un correo con los datos de la reserva</span>
            <script>
                setTimeout(function(){
                    window.location="../paginas/paginaPrincipal.php ";
                }, 2000);
            </script>';
}else{
    echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Se ha producido un error. Vuelva a intentarlo</span>';
}