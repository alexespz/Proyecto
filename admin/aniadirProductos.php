<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../admin/index.html");
}
?>
<html lang="en">
<div class="col-md-9 pull-md-right main-content">
    <div class="col-md-12 text-center"><h1><p>AÑADIR PRODUCTO</p></h1></div>
    <form action="../consultas/nuevoProducto.php" method="POST" enctype="multipart/form-data">
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
                    </select>
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
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
            </div>
            <div class="divider"></div>
            <div class="col-md-12 form-group">
                <div class="col-md-12 form-group">
                    <label for="nombre" class="control-label">Puede contener</label><?php
                    $query = "SELECT * FROM alergeno";
                    $conexion->consultas($query);echo '
                        <table class="table-responsive">
                            <tr>';
                            while($resultado = $conexion->devolverFilas()){echo'
                                <td>
                                    <label id="contenedorImagen">
                                        <input type="checkbox" class="checkImagen" id="alergeno" name="alergeno[]" value="'.$resultado["id_alergeno"].'"/>';
                                        if($resultado["foto"] == "NULL"){
                                            echo '<img src="../imagenes/imagen-no-disponible.gif" id="imagen'.$resultado["id_alergeno"].'"/>';
                                        }else{
                                            echo '<img src="../imagenes/alergenos/'.$resultado["foto"].'" id="imagen'.$resultado["id_alergeno"].'"/>';
                                        }echo'
                                    </label>
                                </td>';
                            }echo '
                            </tr>
                        </table>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-12 " id="boton">
            <button type="submit" class="btn btn-info" id="submit">Añadir</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>
