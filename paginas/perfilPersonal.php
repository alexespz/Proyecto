<?php
session_start();

if(!isset($_SESSION["usuario"])){
  header("Location: inicioSesion.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil personal</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <script src="../sources/jquery.growl.js" type="text/javascript"></script>
    <link href="../sources/jquery.growl.css" rel="stylesheet" type="text/css" />
    <script src="../sources/ajaxPerfil.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
  <div class="container caja">
    <header>
      <div class="row vertical-align text-center">
        <div class="col-md-3 col-sm-3">
          <div id="title-cdi">CONFIGURACIÓN DEL PERFIL</div>
        </div>
      </div>
    </header>
    <hr>  
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="fa fa-user-circle text-success"></span> Ajustes de mi perfil</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <td><a id="editarPerfil">Editar perfil</a></td>
                                    </tr>
                                    <tr>
                                        <td><a id="cambiarContrasena">Cambiar contraseña</a></td>
                                    </tr>
                                    <tr>
                                        <td><a id="verPerfil">Ver perfil</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a id="volverMenu"><span class="glyphicon glyphicon-arrow-left text-success"></span> Volver al menu</a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a id="cerrarSesion"><span class="fa fa-sign-out text-success"></span> Cerrar sesion</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8" id="cuerpo">
                
            </div>
        </div>
    </div>
     </body>
</html>
