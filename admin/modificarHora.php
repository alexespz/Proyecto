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
$sentencia->bindParam('i', $id);
$id = $_GET["id_hora"];
$sentencia->execute();
$sentencia->bind_result($id, $hora);
$sentencia->close();
?>
<script>
    function modificarHora(id, hora){
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/horas/modificarHora.php",
            data: "id="+id+"hora="+hora,
            success: function(resp){
                $('#cuerpo').load("resp");
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
                    <input type="text" name="hora" id="hora" class="form-control" placeholder="<?php echo $hora ?>" >
                </div>
            </div>
        </div>
        <div class="col-md-12 " id="boton">
            <button class="btn btn-info" id="submit" onclick="modificarHora($('#id').val(), $('#hora').val();">Modificar</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>
