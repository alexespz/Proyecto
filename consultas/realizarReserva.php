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

//Configuramos el correo que se le envia al usuario al realizar la reserva
$para      = '.$email.';
$titulo    = 'TU CODIGO DE RESERVA';
$mensaje   = 'Tu codigo de reserva es el siguiente: ' ."\r\n" ?><h1><?php echo $reserva?> </h1><?php;
$cabeceras = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);
