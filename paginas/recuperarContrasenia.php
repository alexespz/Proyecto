<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel ="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script>
        function Validar(email, pass, pass2) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/recuperarContraseña.php",
                data: "email="+email+"&contrasenia="+pass+"&repetirContrasenia="+pass2,
                success: function(resp){
                    $('#resultado').html(resp);
                }
            });
        }
    </script>
</head>
<body>
<div id="contenedorPrincipal" class="col-md-12 container cajaInstalacion">
    <div class="col-md-12"><h1><p>RECUPERAR CONTRASEÑA</p></h1></div>
    <div class="col-md-12"><hr /></div>
    <div class="col-md-12">
        <form class="form-horizontal" id="contenedorInstalacion" action="return false" onsubmit="return false" method="POST">
            <div class="row">
                <div class="col-md-7 form-group">
                    <div class="form-group">
                        <label for="correo" class="control-label">Correo electronico</label>
                        <input type="text" name="correo" id="correo" class="form-control" >
                    </div>
                </div>
                <div class="col-md-7 form-group">
                    <div class="form-group">
                        <label for="pass" class="control-label">Nueva contraseña (introducir dos veces)</label>
                        <input type="password" name="pass" id="pass" class="form-control" >
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass2" id="pass2" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
            <div class="col-md-2" id="boton">
                <button class="btn btn-info" onclick="Validar(document.getElementById('correo').value, document.getElementById('pass').value, document.getElementById('pass2').value);">Instalar</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
