<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../admin/index.html");
}

$query = "SELECT * FROM producto";
$conexion->consultas($query);
echo '
<script>
    $(function() {
        $("input:checkbox").bootstrapToggle();
    });
    
    function eliminarProducto(id){
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/productos/recuperarProducto.php?",
            data: "id=" + id,
            success: function (resp) {
                $("#cuerpo").html(resp);
            }
        });
    }
</script>

<table class="table table-striped col-md-12">
    <tr>
        <td class="col-md-1">ID</td>
        <td class="col-md-3">Activo</td>
        <td class="col-md-3">Nombre</td>
        <td class="col-md-3">Descripcion</td>
        <td class="col-md-2">Acciones</td>
    </tr>
    <tr>';
while($resultado = $conexion->devolverFilas()){
    echo '<td>' .$resultado["id_producto"]. '</td>';
    if($resultado["is_delete"] == "1"){
        echo '<td><input type="checkbox" id="miToggle-'.$resultado["id_producto"].'" data-toggle="toggle" data-width="60" data-height="30" data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" "></td>';
    }else{
        echo '<td><input type="checkbox" id="miToggle-'.$resultado["id_producto"].'" disabled checked data-toggle="toggle" data-width="60" data-height="30" data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" "></td>';
    }echo'
        <td>' .$resultado["nombre"]. '</td>
        <td>' .$resultado["descripcion"]. '</td>
        <td>';
        if($resultado["is_delete"] == 0){ echo '
            <button type="button" class="btn btn-info" href="../admin/modificarProducto.php?id='.$resultado["id_producto"].'"><span class="glyphicon glyphicon-pencil"></span></button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-taget="#Modal" href="../consultas/productos/confirmarEliminarProducto.php?id='.$resultado["id_producto"].'"><span class="glyphicon glyphicon-trash"></span></button>';
        }else{ echo '
            <button type="button" class="btn btn-warning" onclick="eliminarProducto('.$resultado["id_producto"].')"><span class="glyphicon glyphicon-refresh"></span></button>';
        }echo '
        </td>
    </tr>';
}
echo '</table>';
echo 'Resultados obtenidos: ' .$conexion->numFilas();

echo'
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>';