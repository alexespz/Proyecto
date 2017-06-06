<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
    header("Location: ../admin/index.html");
}

$query = "SELECT * FROM alergenos";
$conexion->consultas($query);

echo '
<script>
    $(function() {
        $("#miToggle-").bootstrapToggle();
    });
</script>
<div class="pre-scrollable" style="min-height: 590px;">
<table class="table table-striped col-md-10" >
    <tr>
        <td class="col-md-1">ID</td>
        <td class="col-md-1">Activo</td>
        <td class="col-md-3">Nombre</td>
        <td class="col-md-2">Foto</td>
        <td class="col-md-3">Acciones</td>
    </tr>
    <tr>';
while($resultado = $conexion->devolverFilas()){
    echo '<td>' .$resultado["id_alergeno"]. '</td>';
    if($resultado["is_delete"] == "1"){
        echo '<td><input type="checkbox" id="miToggle-'.$resultado["id_alergeno"].'" disabled data-toggle="toggle" data-width="60" data-height="30" data-onstyle="success" data-offstyle="danger" data-on=" " data-off=""></td>';
    }else{
        echo '<td><input type="checkbox" id="miToggle-'.$resultado["id_alergeno"].'" disabled checked data-toggle="toggle" data-width="60" data-height="30" data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" "></td>';
    }echo'
        <td>' .$resultado["nombre"]. '</td>
        <td><img src="../imagenes/alergenos/'.$resultado["foto"].'" style="width: 60px;"></td>
        <td>';
        if($resultado["is_delete"] == 0){echo '
            <button type="button" class="btn btn-info" href="../admin/modificarAlergeno.php?id='.$resultado["id_alergeno"].'"><span class="glyphicon glyphicon-pencil"></span></button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Modal" href="../consultas/alergenos/confirmarEliminarAlergeno.php?id='.$resultado["id_alergeno"].'"><span class="glyphicon glyphicon-trash"></span></button>';
        }else { echo '
            <button type="button" class="btn btn-warning" href="../consultas/alergenos/recuperarAlergeno.php?id='.$resultado["id_alergeno"].'"><span class="glyphicon glyphicon-refresh"></span></button>';
        }echo '
        </td>
    </tr>';
}
echo '</table>
</div>
<div class="espacios"></div>';

echo 'Resultados obtenidos: ' .$conexion->numFilas();

echo'
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>';
