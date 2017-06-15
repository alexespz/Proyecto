<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro de usuaario</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel ="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <script src="../sources/jquery.growl.js" type="text/javascript"></script>
    <link href="../sources/jquery.growl.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script>
        function Validar(nombre, apellidos, email, telefono, sexo, dni, user, pass, pass2, submit) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/validarRegistro.php",
                data: "nombre="+nombre+"&apellidos="+apellidos+"&email="+email+"&telefono="+telefono+"&sexo="+sexo+"&dni="+dni+"&usuario="+user+"&contrasenia="+pass+"&contrasenia2="+pass2+"&submit="+submit,
                success: function(resp){
                    $('#resultado').html(resp);
                }
            });
        }
    </script>
</head>
<body>
<div id="formulario" class="row container">
        <div class="col-md-12 text-center"><h1><p>REGISTRO DE USUARIOS</p></h1></div>
        <form action="return false" onsubmit="return false" method="POST">
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre *" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Dirección email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Correo electrónico *" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label for="sexo" class="control-label">Sexo</label>
                        <select name="sexo" class="form-control" id="sexo" required>
                            <option value="Hombre">Hombre</option>
                            <option value="Mejer">Mujer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="apellidos" class="control-label">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos *" maxlength="40" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="control-label">Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono *" maxlength="9" required>
                    </div>
                    <div class="form-group">
                        <label for="dni" class="control-label">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI *" maxlength="9" required>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="col-md-12 form-group">
                    <div class="form-group">
                        <label for="usuario" class="control-label">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario *" maxlength="25" required>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="contrasenia" class="control-label">Contraseña</label>
                        <input type="password" name="contrasenia" id="contrasenia" class="form-control" placeholder="Contraseña *" maxlength="25" required>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="contrasenia2" class="control-label">Repita la contraseña</label>
                        <input type="password" name="contrasenia2" id="contrasenia2" class="form-control" placeholder="Repita la contraseña *" maxlength="25" required>
                    </div>
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fa fa-exclamation-triangle"></span> Terminos del servicio y condiciones de uso</h3>
                </div>
                <div class="panel-body ">
                    <div class="col-md-12">
                        <label class="checkbox">
                            <input type="checkbox" name="terminos" class="terminos" required>He leido y estoy deacuerdo con los <a href="../paginas/condiciones.html">terminos del servicio y condiciones de uso</a>
                        </label>
                    </div>
                </div>

            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
            <div class="col-md-12 text-center" id="boton">
                <button class="btn btn-info" id="submit" onclick="Validar(document.getElementById('nombre').value, document.getElementById('apellidos').value, document.getElementById('email').value, document.getElementById('telefono').value, document.getElementById('sexo').value, document.getElementById('dni').value, document.getElementById('usuario').value, document.getElementById('contrasenia').value, document.getElementById('contrasenia2').value, document.getElementById('submit').value);">Entrar</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
