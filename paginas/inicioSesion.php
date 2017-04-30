<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inicio Sesión</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel ="stylesheet">
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
    <div id="contenedor" class="row container text-center">
        <div class="col-md-12"><h1><p>NOMBRE DE LA APLICACION</p></h1></div>
        <div class="col-md-12">
            <form class="form-horizontal espacios" action="../consultas/iniciarSesion.php" method="POST">
                <div class="col-md-12 form-group">
                    <label for="usuario" class="control-label col-md-5">Usuario:</label>
                    <div class="col-md-1"><input type="text" name="usuario" ></div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="contrasenia" class="control-label col-md-5">Contraseña:</label>
                    <div class="col-md-1"><input type="password" name="contrasenia"></div>
                </div>
                <div class="col-md-12 espacios">
                    <button  type="submit" class="btn btn-info">Entrar</button>
                </div>
                <div class="col-md-12 espacios">
                    <a><p>¿Has olvidado la contraseña?</p></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>