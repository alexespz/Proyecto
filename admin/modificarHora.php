<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
    header("Location: ../admin/index.html");
}
$query = "SELECT id_hora, hora FROM hora_reserva WHERE id_hora = ?";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bind_param('i', $id);
$id = $_POST["id"];
$sentencia->execute();
$sentencia->bind_result($id, $hora);
$sentencia->fetch();
$sentencia->close();
?>
<script>
    $(function() {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
    });

    function modificarHora(id, hora){
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/modificarHora.php",
            data: "id="+id+"hora="+hora,
            success: function(resp){
                $('#resultado').html(resp);
            }
        });
    }
</script>
<html lang="en">
<div class="col-md-9 pull-md-right main-content">
    <div class="col-md-12 text-center"><h1><p>MODIFICAR HORA</p></h1></div>
    <form action="return false" onsubmit="return false" method="POST">
        <div class="row">
            <div class="col-md-6 form-group">
                <div class="form-group">
                    <label for="id" class="control-label">ID</label>
                    <input type="text" name="id" id="id" class="form-control" value="<?php echo $id ?>" disabled>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <div class="form-group">
                    <label for="hora" class="control-label">Hora</label>
                    <div class='input-group date' id='datetimepicker3'>
                        <input type='text' class="form-control" id="hora" placeholder="<?php echo $hora ?>"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 " id="boton">
            <button class="btn btn-info" id="submit" onclick="modificarHora($('#id').val(), $('#hora').val());">Modificar</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>
