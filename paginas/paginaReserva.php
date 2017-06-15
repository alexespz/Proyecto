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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/blitzer/jquery-ui.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../sources/bootstrap.js"></script>
    <script src="../sources/jquery.growl.js" type="text/javascript"></script>
    <link href="../sources/jquery.growl.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script>
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yy/mm/dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $(function () {
            $("#fecha").datepicker({
                minDate: "0",
                maxDate: "+14D",
            });
        });

    </script>
</head>
<body>
<div class="container caja">
    <div id="formulario" class="row container">
        <div class="col-md-12 text-center"><h1><p>REALIZAR RESERVA</p></h1></div>
        <div class="pull-right" style="margin-bottom: 40px;">
            <h4 class="panel-title">
                <a href="../paginas/paginaPrincipal.php"><span class="glyphicon glyphicon-log-out text-success"></span> Vovler al Menu Principal</a>
            </h4>
        </div>
        <form action="../consultas/realizarReserva.php" method="POST">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="col-md-6 form-group">
                        <label for="nombre" class="control-label">Titular de la reserva</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" maxlength="20" value="<?php echo $nombre. ' '. $apellidos ?>" disabled>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="comensales" class="control-label">Numero de comensales</label>
                        <select name="comensales" class="form-control" id="comensales" required>
                            <?php
                            for($i = 1; $i <= 40; $i++ ){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <div class="col-md-6 form-group">
                        <label for="fecha" class="control-label">Fecha de la reserva</label>
                        <input type="text" name="fecha" id="fecha" class="form-control" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="hora" class="control-label">Hora de la reserva</label>
                        <select name="hora" class="form-control" id="hora" required>
                            <?php
                            $sql = "SELECT * FROM hora_reserva";
                            $conexion->consultas($sql);
                            while($resultado = $conexion->devolverFilas()){
                                echo '<option value="'.$resultado["id_hora"].'">'.$resultado["hora"].'</option>';
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
                        $query = "SELECT * FROM alergeno";
                        $conexion->consultas($query);echo '
                        <table class="table-responsive">
                            <tr>';
                        while($resultado = $conexion->devolverFilas()){echo'
                                <td>
                                    <label id="contenedorImagen">
                                        <input type="checkbox" class="checkImagen" id="alergeno" name="alergeno[]" value="'.$resultado["id_alergeno"].'"/>';
                            if($resultado["foto"] == "NULL"){
                                echo '<img src="../imagenes/imagen-no-disponible.gif" id="imagen'.$resultado["id_alergeno"].'"/>';
                            }else{
                                echo '<img src="../imagenes/alergenos/'.$resultado["foto"].'" id="imagen'.$resultado["id_alergeno"].'"/>';
                            }echo'
                                    </label>
                                </td>';
                        }   echo '
                            </tr>
                        </table>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
            <div class="col-md-12 text-center" id="boton">
                <button type="submit" class="btn btn-info" id="submit">Reservar</button>
            </div>
        </form>
    </div>
</div>
</div>

</body>
</html>
