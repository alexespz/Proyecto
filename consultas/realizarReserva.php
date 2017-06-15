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
echo $_POST["fecha"];
$sql = "INSERT INTO reserva VALUES ('', ".$idUsuario.", ".$_POST["comensales"].", '".$_POST["fecha"]."', '".$_POST["hora"]."', '".$codigoReserva."')";
$conexion->consultas($sql);

//obtenemos el ultimo id insertado e introducimos los alergenos indicados en la reserva
$lastId = $conexion->ultimoId();

for($i=0; $i<= count($_POST["alergeno"])-1; $i++){
    if($_POST["alergeno"][$i] != NULL){
        $query = "INSERT INTO reserva_alergeno(id_reserva, id_alergeno)VALUES (".$lastId.", ".$_POST["alergeno"][$i].")";
        $conexion->consultas($query);
    }
}

if($conexion->filasAfectadas() > 0){
    //Configuramos el correo que se le envia al usuario al realizar la reserva
    $para      = $email;
    $titulo    = 'DATOS DE LA RESERVA';
    $mensaje   = 'Tu codigo de reserva es el siguiente: '.$codigoReserva;

    $cabeceras = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($para, $titulo, $mensaje, $cabeceras);
    header("Location: ../paginas/paginaPrincipal.php");

    echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Reserva Realizada. Le enviaremos un correo con los datos de la reserva</span>
            <script>
                $.growl.notice({ message: "Reserva realizada. Le enviaremos un correo con los datos de la reserva" });
                setTimeout(function(){
                    window.location="../paginas/paginaPrincipal.php ";
                }, 2000);
            </script>';
}else{
    echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';
}