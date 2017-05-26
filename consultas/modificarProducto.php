<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion->new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../paginas/paginaAdminstrador.php");
}

$query = "SELECT * FROM producto WHERE id_producto = ?";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bindParam('i', $id);
$id = $_GET["id"];
$sentencia->execute();
$sentencia->bind_result($id, $nombre, $descripcion, $precio, $foto, $calorias, $tipo);
$sentencia->close();

?>
<script>
  function modificarProducto(id,nombre,descripcion,precio,foto,calorias,tipo){
    $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/modificarProducto.php",
            data: "id="+id+"nombre="+nombre+"descripcion="+descripcion+"precio="+foto+"calorias="+calorias+"tipo="+tipo,
            success: function(resp){
                $('#cuerpo').load("resp");
            }
        });
  }
</script>
<html lang="en">
    <div class="col-md-9 pull-md-right main-content">
        <div class="col-md-12 text-center"><h1><p>MENU ADMINISTRADOR</p></h1></div>
        <form action="return false" onsubmit="return false" method="POST">
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="form-group">
                        <label for="id" class="control-label">Id Producto</label>
                        <input type="text" name="id" id="id" class="form-control" placeholder="<?php echo $id ?>">
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
                        <input type="text" name="foto" id="foto" class="form-control" placeholder="<?php echo $foto ?>" >
                    </div>
                    <div class="form-group">
                        <label for="calorias" class="control-label">Calorias</label>
                        <input type="text" name="calorias" id="calorias" class="form-control" placeholder="<?php echo $calorias ?>" >
                    </div>
                    <div class="form-group">
                        <label for="tipo" class="control-label">Tipo</label>
                        <input type="text" name="tipo" id="tipo" class="form-control" placeholder="<?php echo $tipo ?>" >
                    </div>
                </div>
            </div>
            <div class="col-md-12 " id="boton">
                <button class="btn btn-info" id="submit" onclick="modificarProducto(document.getElementById('id').value, document.getElementById('nombre').value, document.getElementById('descripcion').value, document.getElementById('precio').value, document.getElementById('foto').value, document.getElementById('calorias').value, document.getElementById('tipo').value);">Modificar</button>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
        </form>
    </div>
</html>
