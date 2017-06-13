<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../procedimientos/carrito.php';

$carrito = new Carrito();
$conexion = new procedimientos();
$conexion->conect();

$obtenerUsuario = "SELECT id_usuario, email FROM usuarios WHERE id_usuario = ?";
$sentencia = $conexion->consultasPreparadas($obtenerUsuario);
$sentencia->bind_param('i', $idUsuario);
$idUsuario = $_SESSION["idUsuario"];
$sentencia->execute();
$sentencia->bind_result($idUsuario, $email);
$sentencia->close();

//Creamos el codigo de pedido aleatorio
$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$codigo = array();
$longitud = strlen($alphabet) - 1;
for ($i = 0; $i < 9; $i++) {
    $cod = rand(0, $longitud);
    $codigo[] = $alphabet[$cod];
}
$codigoPedido = implode($codigo); //devolvemos el array convertido a string

$query = "INSERT INTO pedido VALUES ('', ".$idUsuario.", ".$_POST["total"].", '".$codigoPedido."')";
$conexion->consultas($query);

$lastId = $conexion->ultimoId();
$carro = $carrito->get_content();
$query = "";
foreach ($carro as $producto){
    $query .= "INSERT INTO pedido_producto VALUES('', ".$lastId.", ".$producto["id"].", ".$producto["cantidad"].");";
}
$conexion->multiConsultas($query);

if($conexion->filasAfectadas() > 0){
    $carrito->destroy();

    //Configuramos el correo que se le envia al usuario al realizar la reserva
    $para      = $email;
    $titulo    = 'DATOS DEL PEDIDO';
    $mensaje   = 'Tu codigo de pedido es el siguiente: '.$codigoPe;

    $cabeceras = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($para, $titulo, $mensaje, $cabeceras);

    echo '
            <script>
                $.growl.notice({ message: "Pedido realizado. Le enviaremos un correo con los datos del pedido" });
                setTimeout(function(){
                    window.location="../paginas/paginaPrincipal.php ";
                }, 3000);
            </script>';
}else{
    echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';
}