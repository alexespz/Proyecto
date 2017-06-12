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
    function aniadirProducto(nombre, descripcion, precio, calorias, foto, tipo, alergeno1, alergeno2, alergeno3, alergeno4, alergeno5, alergeno6, alergeno7, alergeno8, alergeno9, alergeno10, alergeno11, alergeno12, alergeno13, alergeno14) {
        var formData = new FormData();
        formData.append("nombre", nombre);
        formData.append("descripcion", descripcion);
        formData.append("precio", precio);
        formData.append("calorias", calorias);
        formData.append("foto", $("#foto")[0].files[0]);
        formData.append("tipo", tipo);
        formData.append("alergeno1", alergeno1);
        formData.append("alergeno2", alergeno2);
        formData.append("alergeno3", alergeno3);
        formData.append("alergeno4", alergeno4);
        formData.append("alergeno5", alergeno5);
        formData.append("alergeno6", alergeno6);
        formData.append("alergeno7", alergeno7);
        formData.append("alergeno8", alergeno8);
        formData.append("alergeno9", alergeno9);
        formData.append("alergeno10", alergeno10);
        formData.append("alergeno11", alergeno11);
        formData.append("alergeno12", alergeno12);
        formData.append("alergeno13", alergeno13);
        formData.append("alergeno14", alergeno14);

        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/nuevoProducto.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
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
                                        <input type="checkbox" class="checkImagen" id="check'.$resultado["id_alergeno"].'" onclick="aniadirAlergeno('.$resultado["id_alergeno"].')"/>
                                        <img src="../imagenes/alergenos/'.$resultado["foto"].'" id="imagen'.$resultado["id_alergeno"].'"/>
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
            <button type="button" class="btn btn-info" id="submit" onclick="aniadirProducto($('#nombre').val(), $('#descripcion').val(), $('#precio').val(), $('#calorias').val(), $('#foto').val(), $('#tipo').val(), $('#check1').prop('checked'),$('#check2').prop('checked'), $('#check3').prop('checked'), $('#check4').prop('checked'), $('#check5').prop('checked'), $('#check6').prop('checked'), $('#check7').prop('checked'), $('#check8').prop('checked'), $('#check9').prop('checked'), $('#check10').prop('checked'), $('#check11').prop('checked'), $('#check12').prop('checked'),$('#check13').prop('checked'), $('#check14').prop('checked'));">Añadir</button>
        </div>
        <div class="col-md-12 espacios" id="resultado"></div>
    </form>
</div>
</html>
