<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
    header("Location: ../admin/index.html");
}
$query = "SELECT id_alergeno, nombre FROM alergeno WHERE id_alergeno = ?";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bindParam('i', $id);
$id = $_POST["id"];
$sentencia->execute();
$sentencia->bind_result($id, $nombre);
$sentencia->fetch();
$sentencia->close();
?>
<script>
    function modificarAlergeno(id, nombre){
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/modificarAlergeno.php",
            data: "id="+id+"nombre="+nombre,
            success: function(resp){
                $('#cuerpo').load("resp");
            }
        });
    }
</script>
<html lang="en">
<div class="col-md-9 pull-md-right main-content">
    <div class="col-md-12 text-center"><h1><p>MODIFICAR ALERGENO</p></h1></div>
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
                    <label for="nombre" class="control-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="<?php echo $nombre ?>" >
                </div>
            </div>
        </div>
        <div class="col-md-12 " id="boton">
            <button class="btn btn-info" id="submit" onclick="modificarAlergeno(document.getElementById('id').value, document.getElementById('nombre').value;">Modificar</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>
