<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inicio Sesión</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel ="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script>
        function Validar(user, pass) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/validarInicioSesion.php",
                data: "usuario="+user+"&contrasenia="+pass,
                success: function(resp){
                    $('#resultado').html(resp);
                }
            });
        }
    </script>
</head>
<body>
    <div id="contenedor" class="row container text-center">
        <div class="col-md-12"><h1><p>NOMBRE DE LA APLICACION</p></h1></div>
        <div class="col-md-12">
            <form class="form-horizontal" action="return false" onsubmit="return false" method="POST">
                <div class="col-md-12 form-group">
                    <label for="usuario" class="control-label col-md-5">Usuario:</label>
                    <div class="col-md-1"><input type="text" name="usuario" id="usuario"></div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="contrasenia" class="control-label col-md-5">Contraseña:</label>
                    <div class="col-md-1"><input type="password" name="contrasenia" id="pass"></div>
                </div>
                <div class="col-md-12 espacios" id="resultado"></div>
                <div class="col-md-12" id="boton">
                    <button class="btn btn-info" onclick="Validar(document.getElementById('usuario').value, document.getElementById('pass').value);">Entrar</button>
                </div>
                <div class="col-md-12 espacios">
                    <a href="formularioRegistro.php" class="alert-link" style="color: black;">¿No tienes una cuenta?</a>&nbsp|&nbsp<a class="alert-link" style="color: black;">¿Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
