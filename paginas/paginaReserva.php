<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../consultas/obtenerPerfil.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuarios"])){
  header("Location: ../paginas/inicioSesion.php");
}
?>

<head>
    <meta charset="UTF-8">
    <title>Realizar reserva</title>
    <link type="text/css" href="../sources/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="../sources/cssPropio.css" rel ="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <script>
        $(window).ready(function(){
          $.datepicker.setDefaults($.datepicker.regional["es"]);
          $("#fecha").datepicker({
            firstDay: 1,
            minDate: -20,
            maxDate: "+1M +10D" 
          });
        });
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
    <div class="col-md-9 pull-md-right main-content">
        <div class="col-md-12 text-center"><h1><p>REALIZAR RESERVA</p></h1></div>
        <form action="return false" onsubmit="return false" method="POST">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="col-md-9 form-group">
                        <label for="nombre" class="control-label">Titular de la reserva</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" maxlength="20" value="<?php echo $nombre. ' '. $apellidos ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="comensales" class="control-label">Numero de comensales</label>
                        <select name="comensales" class="form-control" id="comensales" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                  <div class="col-md-9 form-group">
                        <label for="fecha" class="control-label">Fecha de la reserva</label>
                        <input type="text" name="fecha" id="fecha" class="form-control" required>
                   </div>
                   <div class="col-md-3 form-group">
                        <label for="hora" class="control-label">Hora de la reserva</label>
                        <select name="hora" class="form-control" id="hora" required>
                            <?php
                             $sql = "SELECT hora FROM hora_reserva";
                             $conexion->consultas($sql);
                             while($conexion->devolverFilas()){
                              echo <option value="resultado['hora']">resultado['hora']</option>
                             }
                        </select>
                   </div>
                </div>
                <div class="divider"></div>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
            <div class="col-md-12 text-center" id="boton">
                <button class="btn btn-info" id="submit" onclick="Validar(document.getElementById('nombre').value, document.getElementById('apellidos').value, document.getElementById('email').value, document.getElementById('telefono').value, document.getElementById('sexo').value, document.getElementById('dni').value, document.getElementById('usuario').value, document.getElementById('contrasenia').value, document.getElementById('contrasenia2').value, document.getElementById('submit').value);">Reservar</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
