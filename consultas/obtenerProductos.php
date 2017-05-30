<?php
session_start();
include_once '../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conexion->conect();
?>
<script>
    function aniadirProducto(id) {
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/aniadirProducto.php",
            data: "id=" + id,
            success: function (resp) {
                $('#pedido').html(resp);
            }
        });
    }
</script>

<?php
$obtenerProductos = "SELECT id_producto,nombre,precio FROM producto WHERE tipo_producto = ?";
$sentenciaProductos = $conexion->consultasPreparadas($obtenerProductos);
$sentenciaProductos->bind_param('i', $tipo);
$tipo = $_POST["tipo"];
$sentenciaProductos->execute();
$sentenciaProductos->bind_result($id_producto, $nombre, $precio);

echo '<table class="table table-striped col-md-9">
            <tr>
                <td class="col-md-6">Nombre</td>
                <td class="col-md-2 text-center">Precio </td>
                <td class="col-md-1">Acciones</td>
            </tr>
            <tr>';
            while($sentenciaProductos->fetch()){
            echo'<td class="text-uppercase"> -  ' .$nombre. ' </td>
                 <td class="text-uppercase text-center">' .$precio. ' €</td>
                 <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal" href="../consultas/obtenerModal.php?id='.$id_producto.'"><span class="fa fa-eye"></span></button> <button type="button" class="btn btn-success" onclick="aniadirProducto('.$id_producto.')"><span class="fa fa-plus"></span></button></td>
            </tr>';
            }
echo '</table>';
echo 'Resultados Obtenidos: ' .$conexion->numFilas();
$sentenciaProductos->close();

echo'
            <!-- Modal -->
            <div class="modal fade" id="Modal" tabindex="-1" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                    </div>
                </div>
            </div>';
