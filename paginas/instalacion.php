<?php
include_once '../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conectado = $conexion->conect();
if($conectado){
    header ("Location: ../paginas/inicioSesion.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instalacion</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel ="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script>
        function Validar(user, pass, pass2, email) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/validarInstalacion.php",
                data: "usuario="+user+"&contrasenia="+pass+"&repetirContrasenia="+pass2+"&email="+email,
                success: function(resp){
                    $('#resultado').html(resp);
                }
            });
        }
    </script>
</head>
<body>
<div id="contenedorPrincipal" class="col-md-12 container cajaInstalacion">
    <div class="col-md-12"><h1><p>BIENVENIDO</p></h1></div>
    <div class="col-md-12"><hr /></div>
    <div class="col-md-12"><p>Bienvenido al proceso de instalación de "insertar nombre de la aplicacion".</p>
        <p>Se trata de un proceso muy sencillo y que no te llevará más de dos minutos. Rellena los datos más abajo y podrás comenzar a utilizar la mejor plataforma de reserva y pedidos en restaurantes.</p></div>
    <div class="col-md-12"><h1><p>DATOS NECESARIOS</p></h1></div>
    <div class="col-md-12"><hr /></div>
    <div class="col-md-12">
        <form class="form-horizontal" id="contenedorInstalacion" action="return false" onsubmit="return false" method="POST">
            <div class="row">
                <div class="col-md-7 form-group">
                    <div class="form-group">
                        <label for="usuario" class="control-label">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" >
                    </div>
                </div>
                <div class="col-md-7 form-group">
                    <div class="form-group">
                        <label for="pass" class="control-label">Contraseña (introducir dos veces)</label>
                        <input type="password" name="pass" id="pass" class="form-control" >
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass2" id="pass2" class="form-control" >
                    </div>
                </div>
                <div class="col-md-7 form-group">
                    <div class="form-group">
                        <label for="email" class="control-label">Tu correo electónico</label>
                        <input type="text" name="email" id="email" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
            <div class="col-md-2" id="boton">
                <button class="btn btn-info" onclick="Validar(document.getElementById('usuario').value, document.getElementById('pass').value, document.getElementById('pass2').value, document.getElementById('email').value);">Instalar</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
