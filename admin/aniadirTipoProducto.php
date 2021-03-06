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
    function aniadirTipoProducto(nombre) {
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/nuevoTipoProducto.php",
            data: "nombre="+nombre,
            success: function(resp){
                $('#resultado').html(resp);
            }
        });
    }
</script>
<html lang="en">
<div class="col-md-9 pull-md-right main-content">
    <div class="col-md-12 text-center"><h1><p>AÑADIR TIPO PRODUCTO</p></h1></div>
    <form action="return false" onsubmit="return false" method="POST">
        <div class="row">
            <div class="col-md-6 form-group">
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="col-md-12 " id="boton">
            <button class="btn btn-info" id="submit" onclick="aniadirTipoProducto($('#nombre').val());">Añadir</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>
