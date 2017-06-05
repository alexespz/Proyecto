<?php
include_once '../../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conexion->conect();
?>
<script>
    function eliminarAlergeno(id) {
        $.ajax({
            async: true,
            type: "POST",
            url: "eliminarAlergeno.php",
            data: "id=" + id,
            success: function (resp) {

            }
        });
    }
</script>
<?php
echo '
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="Modal_Label_' . $_GET["id"] . '">Aviso</h4>
</div>
<div class="modal-body col-md-12">
    <p>¿Seguro que desea eliminar el elemento seleccionado?</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary pull-right" onclick="eliminarAlergeno('.$_GET["id"].')">Si</button>
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No</button>
</div>';
