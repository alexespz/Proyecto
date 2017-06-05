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
    function aniadirProducto(nombre, descripcion, precio, calorias, foto, tipo) {
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/productos/nuevoProducto.php",
            data: "nombre="+nombre+"&descripcion="+descripcion+"&precio="+precio+"&calorias="+calorias+"&foto="+foto+"&tipo="+tipo,
            success: function(resp){
                $('#resultado').html(resp);
            }
        });
    }
</script>
<html lang="en">
<div class="col-md-9 pull-md-right main-content">
    <div class="col-md-12 text-center"><h1><p>AÑADIR PRODUCTO</p></h1></div>
    <form action="return false" onsubmit="return false" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="16000000"/>
        <div class="row">
            <div class="col-md-6 form-group">
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="precio" class="control-label">Precio</label>
                    <input type="text" name="precio" id="precio" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tipo" class="control-label">Tipo de producto</label>
                    <select name="tipo" class="form-control" id="tipo" required>
                      <?php
                      $query = "SELECT * FROM tipo_producto";
                      $conexion->consultas($query);
                      while($resultado = $conexion->devolverFilas()){
                        echo '<option value="'.$resultado["id_tipo_producto"].'">'.$resultado["nombre"].'</option>';
                      }?>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <div class="form-group">
                    <label for="descripcion" class="control-label">Descripcion</label>
                    <input type="text" name="descripcion" id="descipcion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="calorias" class="control-label">Calorias</label>
                    <input type="text" name="calorias" id="calorias" class="form-control">
                </div>
            </div>
            <div class="divider"></div>
            <div class="col-md-8 form-group">
                <div class="form-group">
                    <label for="foto" class="control-label">Foto</label>
                    <input type="file" name="imagen" id="foto" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-12 " id="boton">
            <button class="btn btn-info" id="submit" onclick="aniadirProducto($('#nombre').val(), $('#descripcion').val(), $('#precio').val(), $('#calorias').val(), $('#foto').val(), $('#tipo').val());">Añadir</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>
