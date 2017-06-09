<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
    header("Location: ../admin/index.html");
}
?>
<script>
    function aniadirAlergeno(nombre, foto) {
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/nuevoAlergeno.php",
            data: "nombre="+nombre+"&foto="+foto,
            success: function(resp){
                $('#resultado').html(resp);
            }
        });
    }
</script>
<html lang="en">
<div class="col-md-9 pull-md-right main-content">
    <div class="col-md-12 text-center"><h1><p>AÑADIR ALERGENO</p></h1></div>
    <form action="return false" onsubmit="return false" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="16000000"/>
        <div class="row">
            <div class="col-md-6 form-group">
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
            </div>
            <div class="col-md-8 form-group">
                <div class="form-group">
                    <label for="foto" class="control-label">Foto</label>
                    <input type="file" name="imagen" id="foto" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-12 " id="boton">
            <button class="btn btn-info" id="submit" onclick="aniadirAlergeno($('#nombre').val(), $('#foto').val());">Añadir</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>