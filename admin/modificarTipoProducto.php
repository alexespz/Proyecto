<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../admin/index.html");
}

$query = "SELECT id_tipo_producto, nombre FROM tipo_producto WHERE id_tipo_producto = ?";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bindParam('i', $id);
$id = $_GET["id_tipo_producto"];
$sentencia->execute();
$sentencia->bind_result($id, $tipo);
$sentencia->close();
?>
<script>
    function modificarTipoProducto(id, tipo){
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/modificarTipoProducto.php",
            data: "id="+id+"&tipo="+tipo,
            success: function(resp){
                $('#cuerpo').load("resp");
            }
        });
    }
</script>
<html lang="en">
    <div class="col-md-9 pull-md-right main-content">
        <div class="col-md-12 text-center"><h1><p>MODIFICAR TIPO DE PRODUCTO</p></h1></div>
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
                        <label for="tipo" class="control-label">Tipo</label>
                        <input type="text" name="tipo" id="tipo" class="form-control" placeholder="<?php echo $tipo ?>" >
                    </div>
                </div>
            </div>
            <div class="col-md-12 " id="boton">
                <button class="btn btn-info" id="submit" onclick="modificarTipoProducto($('#id').val(), $('#tipo').val();">Modificar</button>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
        </form>
    </div>
</html>
