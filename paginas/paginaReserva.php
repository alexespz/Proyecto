<?php
session_start();
include_once '../procedimientos/procedimientos.php';
include_once '../consultas/obtenerPerfil.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../paginas/inicioSesion.php");
}
?>
<html>
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
      
        function Validar(nombre, comensales, fecha, hora, alergeno1, alergeno2, alergeno3, alergeno4, alergeno5, alergeno6, alergeno7, alergeno8, alergeno9, alergeno10, alergeno11, alergeno12, alergeno13, alergeno14) {
            $.ajax({
                async: true,
                type: "POST",
                url: "../consultas/realizarReserva.php",
                data: "nombre="+nombre+"&comensales="+comensales+"&fecha="+fecha+"&hora="+hora+"&alergeno1="+alergeno1+"&alergeno2="+alergeno2+"&alergeno3="+alergeno3+"&alergeno4="+alergeno4+"&alergeno5="+alergeno5+"&alergeno6="+alergeno6+"&alergeno7="+alergeno7+"&alergeno8="+alergeno8+"&alergeno9="+alergeno9+"&alergeno10="+alergeno10+"&alergeno11="+alergeno11+"&alergeno12="+alergeno12+"&alergeno13="+alergeno13+"&alergeno14="+alergeno14,
                success: function(resp){
                    $('#resultado').html(resp);
                }
            });
        }

        function ActivarImagen(id){
            $('#imagen'+id).hover(function(){
                $('#imagen'+id).css({"cursor": "pointer"});
            }, function(){
                $('#imagen'+id).css({"cursor": "auto"});
            });

            $('#imagen'+id).on(click, function(){
                $('#imagen'+id).css({"background-color": "red", "transform": "scale(1.2,1.2)", "transition": "all .2s ease-in-out"});
                $('#imagen'+id).attr('active', 'true');

            }, function(){
                $('#imagen'+id).css({"background-color": "transparent", "transform": "scale(1,1)", "transition": "all .2s ease-in-out"});
                $('#imagen'+id).attr('active', 'false');
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
                        <input type="text" name="nombre" id="nombre" class="form-control" maxlength="20" value="<?php echo $nombre. ' '. $apellidos ?>" disabled>
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
                        while($resultado = $conexion->devolverFilas()){
                            echo '<option value="'.$resultado["hora"].'">'.$resultado["hora"].'</option>';
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="col-md-12 form-group">
                    <div class="col-md-12 form-group">
                        <label for="nombre" class="control-label">Alergias (En caso de que alguno de los comensales padezca algún tipo de alergia)</label>
                        <?php
                        $query = "SELECT * FROM alergenos";
                        $conexion->consultas($query);
                        while($resultado = $conexion->devolverFilas()){
                            echo '<table>
                                <tr>
                                    <td><div id="contenedorImagen"><img src="../imagenes/alergenos/'.$resultado["foto"].'" id="imagen'.$resultado["id_alergeno"].'" onclick="ActivarImagen('.$resultado["id_alergeno"].');" active="false"/></div></td>
                                </tr>
                            </table>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
            <div class="col-md-12 text-center" id="boton">
                <button class="btn btn-info" id="submit" onclick="Validar(document.getElementById('nombre').value, document.getElementById('comensales').value, document.getElementById('fecha').value, document.getElementById('hora').value, $('#imagen1').attr('active'),$('#imagen2').attr('active'), $('#imagen3').attr('active'), $('#imagen4').attr('active'), $('#imagen5').attr('active'), $('#imagen6').attr('active'), $('#imagen7').attr('active'), $('#imagen8').attr('active'), $('#imagen9').attr('active'), $('#imagen10').attr('active'), $('#imagen11').attr('active'), $('#imagen12').attr('active'),$('#imagen13').attr('active'), $('#imagen14').attr('active') );">Reservar</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
