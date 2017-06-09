<script>
    function eliminarUsuario(id) {
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/eliminarUsuario.php",
            data: "id=" + id,
            success: function (resp) {
                $("#cuerpo").html(resp);
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
    <button type="button" class="btn btn-primary pull-right" onclick="eliminarUsuario('.$_GET["id"].')" data-dismiss="modal">Si</button>
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No</button>
</div>';