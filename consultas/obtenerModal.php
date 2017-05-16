<?php
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$obtenerProductos = "SELECT * FROM producto WHERE id_producto = ?";
$sentenciaProductos = $conexion->consultasPreparadas($obtenerProductos);
$sentenciaProductos->bind_Param('i', $id);
$id = $_GET["id"];
$sentenciaProductos->execute();
$sentenciaProductos->bind_result($id_producto, $nombre, $descripcion, $precio, $foto, $calorias, $tipo);
$sentenciaProductos->fetch();
echo '
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="Modal_Label_' . $id_producto . '">' . $nombre . '</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="alumno" class="col-md-3 control-label">Producto:</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" id="alumno" value="' . $nombre . '" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="alumno" class="col-lg-12 control-label">Descripcion:</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" id="alumno" value="' . $descripcion . '" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="alumno" class="col-md-12 control-label">Precio:</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" id="alumno" value="' . $precio . ' €" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="alumno" class="col-md-12 control-label">Foto:</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" id="alumno" value="' . $foto . '" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="alumno" class="col-md-12 control-label">Calorias:</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" id="alumno" value="' . $calorias . '" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="alumno" class="col-md-12 control-label">Alergenos:</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" id="alumno" value="" disabled>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-succes" href="/*VALIDAR MEDIANTE AJAX*/">Añadir al pedido</a>
</div>';
$sentenciaProductos->close();