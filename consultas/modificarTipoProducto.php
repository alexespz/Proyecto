<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion->new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../paginas/paginaAdminstrador.php");
}

$query = "SELECT * FROM producto WHERE id_tipo_producto = ?";
$sentencia = $conexion->consultasPreparadas($query);
$sentencia->bindParam('i', $id);
$id = $_GET["id"];
$sentencia->execute();
$sentencia->bind_result($id, $tipo);
$sentencia->close();
?>
<script>
  function modificarTipoProducto(tipo){
    $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/modificarTipoProducto.php",
            data: "tipo="+tipo,
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
                <button class="btn btn-info" id="submit" onclick="modificarTipoProducto(document.getElementById('id').value, document.getElementById('tipo').value;">Modificar</button>
            </div>
            <div class="col-md-12 espacios" id="resultado"></div>
        </form>
    </div>
</html>