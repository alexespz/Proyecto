<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../admin/index.html");
}

$query = "SELECT id_producto, nombre, descripcion, precio, foto, calorias, tipo_producto FROM producto WHERE id_producto = ?";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bindParam('i', $id);
$id = $_GET["id_producto"];
$sentencia->execute();
$sentencia->bind_result($id, $nombre, $descripcion, $precio, $foto, $calorias, $tipo);
$sentencia->close();

?>
<script>
    function modificarProducto(id, nombre, descripcion, precio, foto, calorias, tipo){
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/modificarProducto.php",
            data: "id="+id+"&nombre="+nombre+"&descripcion="+descripcion+"&precio="+precio+"&foto="+foto+"&calorias="+calorias+"&tipo="+tipo,
            success: function(resp){
                $('#resultado').html(resp);
            }
        });
    }
</script>
<html lang="en">
    <div class="col-md-9 pull-md-right main-content">
        <div class="col-md-12 text-center"><h1><p>MODIFICAR PRODUCTO</p></h1></div>
        <form action="return false" onsubmit="return false" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="16000000"/>
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="id" class="control-label">Id Producto</label>
                        <input type="text" name="id" id="id" class="form-control" placeholder="<?php echo $id ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="<?php echo $nombre ?>">
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripcion</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="<?php echo $descripcion ?>" >
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="precio" class="control-label">Precio</label>
                        <input type="text" name="precio" id="precio" class="form-control" placeholder="<?php echo $precio ?>" >
                    </div>
                    <div class="form-group">
                        <label for="foto" class="control-label">Foto</label>
                        <input type="file" name="imagen" id="foto" class="form-control" placeholder="<?php echo $foto ?>">
                    </div>
                    <div class="form-group">
                        <label for="calorias" class="control-label">Calorias</label>
                        <input type="text" name="calorias" id="calorias" class="form-control" placeholder="<?php echo $calorias ?>" >
                    </div>
                    <div class="form-group">
                        <label for="tipo" class="control-label">Tipo</label>
                        <select name="tipo" class="form-control" id="tipo" required> <?php
                        $query = "SELECT id_tipo_producto, nombre FROM tipo_producto WHERE id_tipo_producto = '".$tipo."' ";
                        $conexion->consultas($query);
                        while ($resultado = $conexion->devolverFilas()){ ?>
                            <option value="<?php echo $resultado["id_tipo_producto"] ?>"><?php echo $resultado["nombre"] ?> </option>
                        </select> <?php
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 " id="boton">
                <button class="btn btn-info" id="submit" onclick="modificarProducto($('#id').val(), $('#nombre').val(), $('#descripcion').val(), $('#precio').val(), $('#foto').val(), $('#calorias').val(), $('#tipo').val());">Modificar</button>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
        </form>
    </div>
</html>
