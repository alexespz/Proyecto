<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$obtenerUsuario = "SELECT id_usuario, email FROM usuarios WHERE nombre = ?";
$sentencia = $conexion->consultasPreparadas($obtenerUsuario);
$sentencia->bind_param('s', $nombre);
$nombre = substr($_POST["usuario"], " ");
$sentencia->execute();
$sentencia->bind_result($id, $email);
$sentencia->close();

//Creamos el codigo de reserva aleatorio
$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$codigo = array();
$longitud = strlen($alphabet) - 1;
for ($i = 0; $i < 9; $i++) {
    $cod = rand(0, $longitud);
    $codigo[] = $alphabet[$cod];
}
$codigoRerseva = implode($codigo); //devolvemos el array convertido a string

$sql = "INSERT INTO reserva(id_usuario,comensales,fecha_reserva,hora_reserva,codigo_reserva) VALUES(?,?,?,?)";
$sentencia = $conexion->consultasPreparadas($sql);
$sentencia->bind_param('iisi', $usuario, $comensales, $fecha, $hora, $reserva);
$usuario = $id;
$comensales = $_POST["comensales"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$reserva = $codigoReserva;
$sentencia->execute();
$sentencia->bind_result($reserva);
$sentencia->close();

//obtenemos el ultimo id insertado e introducimos los alergenos indicados en la reserva
$lastId = $conexion->ultimoId();
if($_POST["alergeno1"] == "true"){
    $query = "INSERT INTO reserva_alergeno VALUES('".$lastId."', 1);";
}

if($_POST["alergeno2"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 2);";
}

if($_POST["alergeno3"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 3);";
}

if($_POST["alergeno4"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 4);";
}

if($_POST["alergeno5"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 5);";
}

if($_POST["alergeno6"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 6);";
}

if($_POST["alergeno7"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 7);";
}

if($_POST["alergeno8"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 8);";
}

if($_POST["alergeno9"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 9);";
}

if($_POST["alergeno10"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 10);";
}

if($_POST["alergeno11"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 11);";
}

if($_POST["alergeno12"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 12);";
}

if($_POST["alergeno13"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 13);";
}

if($_POST["alergeno14"] == "true"){
    $query .= "INSERT INTO reserva_alergeno VALUES('".$lastId."', 14);";
}

$conexion->multiConsultas($query);

//Configuramos el correo que se le envia al usuario al realizar la reserva
$para      = $email;
$titulo    = 'CODIGO DE RESERVA';
$mensaje   = 'Tu codigo de reserva es el siguiente: '.$reserva;

$cabeceras = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);
