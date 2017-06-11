<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inicio Sesion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory
    <link rel="shortcut icon" href="favicon.ico"> -->
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Merriweather:300,400italic,300italic,400,700italic' rel='stylesheet' type='text/css'>
    <!-- Animate.css -->
    <link rel="stylesheet" href="../sources/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../sources/icomoon.css">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="../sources/simple-line-icons.css">
    <!-- Datetimepicker -->
    <link rel="stylesheet" href="../sources/bootstrap-datetimepicker.min.css">
    <!-- Flexslider -->
    <link rel="stylesheet" href="../sources/flexslider.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../sources/bootstrap.css">
    <link rel="stylesheet" href="../sources/style.css">
    <!-- jQuery -->
    <script src="../sources/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="../sources/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="../sources/bootstrap.min.js"></script>
    <!-- Bootstrap DateTimePicker -->
    <script src="../sources/moment.js"></script>
    <script src="../sources/bootstrap-datetimepicker.min.js"></script>
    <!-- Waypoints -->
    <script src="../sources/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="../sources/jquery.stellar.min.js"></script>
    <!-- Flexslider -->
    <script src="../sources/jquery.flexslider-min.js"></script>
    <!-- Main JS -->
    <script src="../sources/main.js"></script>
    <!-- Modernizr JS -->
    <script src="../sources/modernizr-2.6.2.min.js"></script>
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

<div id="fh5co-container">
    <div id="fh5co-home" class="js-fullheight" data-section="home">
        <div class="flexslider">
            <div class="fh5co-overlay"></div>
            <div class="fh5co-text">
                <div class="container">
                    <div class="row">
                        <h1 class="to-animate">Manducare</h1>
                    </div>
                    <form class="form-horizontal" action="return false" onsubmit="return false" method="POST">
                        <div class="col-md-12 form-group">
                            <label for="usuario" class="control-label col-md-5" style="color: white;">Usuario:</label>
                            <div class="col-md-1"><input type="text" name="usuario" id="usuario"></div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="contrasenia" class="control-label col-md-5" style="color: white;">Contraseña:</label>
                            <div class="col-md-1"><input type="password" name="contrasenia" id="pass"></div>
                        </div>
                        <div class="col-md-12 espacios" id="resultado"></div>
                        <div class="col-md-12" id="boton">
                            <button class="btn btn-info" onclick="Validar(document.getElementById('usuario').value, document.getElementById('pass').value);">Entrar</button>
                        </div>
                        <div class="col-md-12 espacios">
                            <a href="formularioRegistro.php" class="alert-link" style="color: white;">¿No tienes una cuenta?</a>&nbsp|&nbsp<a href="recuperarContrasenia.php" class="alert-link" style="color: white;">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>
            <ul class="slides">
                <li style="background-image: url(../imagenes/slide_1.jpg);" data-stellar-background-ratio="0.5"></li>
                <li style="background-image: url(../imagenes/slide_2.jpg);" data-stellar-background-ratio="0.5"></li>
                <li style="background-image: url(../imagenes/slide_3.jpg);" data-stellar-background-ratio="0.5"></li>
            </ul>

        </div>

    </div>
</div>
</body>
</html>