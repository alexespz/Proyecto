<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../admin/index.html");
}

$query = "SELECT * FROM hora_reserva";
$conexion->consultas($query);

echo '
<script>
    $(function() {
        $("#miToggle-").bootstrapToggle();
    });
</script>

<table class="table table-striped col-md-9">
    <tr>
        <td class="col-md-1">ID</td>
        <td class="col-md-1">Activo</td>
        <td class="col-md-3">Hora</td>
        <td class="col-md-3">Acciones</td>
    </tr>
    <tr>';
while($resultado = $conexion->devolverFilas()){
        echo '<td>' .$resultado["id_hora"]. '</td>';
        if($resultado["is_delete"] == "1"){
            echo '<td><input type="checkbox" id="miToggle-'.$resultado["id_hora"].'" disabled data-toggle="toggle" data-width="60" data-height="30" data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" "></td>';
        }else{
            echo '<td><input type="checkbox" id="miToggle-'.$resultado["id_hora"].'" disabled checked data-toggle="toggle" data-width="60" data-height="30" data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" "></td>';
        }echo'
        <td>' .$resultado["hora"]. '</td>
        <td>';
            if($resultado["is_delete"] == 0){echo '
                <button type="button" class="btn btn-info" href="../admin/modificarHora.php?id='.$resultado["id_hora"].'"><span class="glyphicon glyphicon-pencil"></span></button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Modal" href="../consultas/horas/confirmarEliminarHora.php?id='.$resultado["id_hora"].'"><span class="glyphicon glyphicon-trash"></span></button>';
            }else{ echo '
                <button type="button" class="btn btn-warning" href="../consultas/horas/recuperarHora.php?id='.$resultado["id_hora"].'"><span class="glyphicon glyphicon-refresh"></span></button>';
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