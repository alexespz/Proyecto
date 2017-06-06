<?php
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
$obtenerProductos = "SELECT * FROM producto WHERE id_producto = ?";
$sentenciaProductos = $conexion->consultasPreparadas($obtenerProductos);
$sentenciaProductos->bind_Param('i', $id);
$id = $_GET["id"];
$sentenciaProductos->execute();
$sentenciaProductos->bind_result($id_producto, $nombre, $descripcion, $precio, $foto, $calorias, $tipo);
$sentenciaProductos->fetch();
$sentenciaProductos->close();

echo '
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="Modal_Label_' . $id_producto . '">'.$nombre.'</h4>
</div>
<div class="modal-body col-md-12">
    <div class="col-md-8" id="contenidoTexto">
        <p><h1>'.$nombre.'</h1></p>
        <p class="divider"></p>
        <p>'.$descripcion.'</p>
        <p>'.$calorias.' Calorias</p>
        <p class="divider"></p>
        <p>Puede contener:</p>
        <p>';
            $obtenerAlergenos = "SELECT id_alergeno FROM producto_alergeno WHERE id_producto = '".$_GET["id"]."' ";
            $conexion->consultas($obtenerAlergenos);
            while($resultado = $conexion->devolverFilas()){
                $obtenerFotoAlergeno = "SELECT foto FROM alergenos WHERE id_alergeno = '".$resultado["id_alergeno"]."' ";
                $conexion->consultas($obtenerFotoAlergeno);
                if($resultadoFoto = $conexion->devolverFilas()){
                    echo '<img src="../imagenes/alergenos/'.$resultado["foto"].'" />';
                }
            }
        echo '    
        </p>
    </div>
    <div class="col-md-4" id="contenidoFoto">
        <div id="imagen">';
            if($foto == "null"){
                echo '<img src="../imagenes/imagen-no-disponible.gif"/>';
            }else{
                echo '<img src="../imagenes/productos/'.$foto.'"/>';
            }echo'
        </div>
        <div id="precio">
            <p>Precio: '.$precio.'€</p>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-info" data-dismiss="modal" onclick="aniadirProducto('.$id_producto.')">Añadir al pedido</button>
</div>';
