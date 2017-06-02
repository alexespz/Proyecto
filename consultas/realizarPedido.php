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
$sentencia->bind_result($id, $email);
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

$query = "INSERT INTO pedido(id_usuario, precio, codigo_pedido) VALUES (?,?,?)";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bind_param('iis', $idUsuario, $precio, $codigoPe);
$idUsuario = $_SESSION["usuario"];
$precio = $_GET["total"];
$codigoPe = $codigoPedido;
$sentencia->execute();
$sentencia->bind_result($idUsuario, $precio, $codigoPe);
$sentencia->close();

$lastId = $conexion->ultimoId();
foreach ($_SESSION["carrito"] as $producto){
    $query .= "INSERT INTO pedido_producto VALUES(".$lastId.", ".$producto["id"].", ".$producto["cantidad"].")";
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

    echo '<span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Pedido Realizado. Le enviaremos un correo con los datos del pedido</span>
            <script>
                setTimeout(function(){
                    window.location="../paginas/paginaPrincipal.php ";
                }, 1200);
            </script>';
}else{
    echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Se ha producido un error. Vuelva a intentarlo</span>';
}