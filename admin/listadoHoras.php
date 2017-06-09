<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../admin/index.html");
}

if(!isset($_POST["pagina"])){
    $page=1;
}else{
    $page = $_POST["pagina"];
}
$results_per_page = 10;
$start_from = ($page-1) * $results_per_page;

$sql = "SELECT * FROM hora_reserva ORDER BY id_hora ASC LIMIT ".$start_from.", ".$results_per_page;
$conexion->consultas($sql);

echo '
<script>
    $(function() {
        $("input:checkbox").bootstrapToggle();
    });
    
    function recuperarHora(id){
        $.ajax({
            async: true,
            type: "POST",
            url: "../consultas/recuperarHora.php",
            data: "id=" + id,
            success: function (resp) {
                $("#cuerpo").html(resp);
            }
        });
    }
    
    function modificarHora(id){
        $.ajax({
            async: true,
            type: "POST",
            url: "../admin/modificarHora.php",
            data: "id=" + id,
            success: function (resp) {
                $("#cuerpo").html(resp);
            }
        });
    }
    
    function primeraPagina(page){
        $.ajax({
            async: true,
            type: "POST",
            url: "../admin/listadoHoras.php",
            data: "pagina=" + page,
            success: function (resp) {
                $("#cuerpo").html(resp);
            }
        });
    }
    
    function pagina(page){
        $.ajax({
            async: true,
            type: "POST",
            url: "../admin/listadoHoras.php",
            data: "pagina=" + page,
            success: function (resp) {
                $("#cuerpo").html(resp);
            }
        });
    }
    
    function ultimaPagina(page){
        $.ajax({
            async: true,
            type: "POST",
            url: "../admin/listadoHoras.php",
            data: "pagina=" + page,
            success: function (resp) {
                $("#cuerpo").html(resp);
            }
        });
    }
</script>

<table class="table table-striped table-responsive col-md-9">
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
                <button type="button" class="btn btn-info" href="modificarHora('.$resultado["id_hora"].')"><span class="glyphicon glyphicon-pencil"></span></button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar" href="../consultas/confirmarEliminarHora.php?id='.$resultado["id_hora"].'"><span class="glyphicon glyphicon-trash"></span></button>';
            }else{ echo '
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalRecuperar" href="../consultas/confirmarRecuperarHora.php?id='.$resultado["id_hora"].'"><span class="glyphicon glyphicon-trash"></span></button>';
            }echo '
        </td>
    </tr>';
}
echo '</table>';
echo 'Resultados obtenidos: ' .$conexion->numFilas();
echo "<br/>";

$sql = "SELECT COUNT(id_hora) AS total FROM hora_reserva";
$conexion->consultas($sql);
$resultado = $conexion->devolverFilas();

$total_pages = ceil($resultado["total"] / $results_per_page);
echo '
<div class="text-center">
    <ul class="pagination">';
for ($i=1; $i<=$total_pages; $i++){ echo'
        <li class="page-item">
          <a class="page-link" onclick="primeraPagina(1)" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>';
    if($page == $i){
        echo '<li class="page-item active"><a onclick="pagina('.$i.')">' . $i . '</a></li>';
    }else {
        echo '<li class="page-item"><a onclick="pagina('.$i.')">' . $i . '</a></li>';
    }echo '
        <li class="page-item">
          <a class="page-link" onclick="ultimaPagina('.$total_pages.')" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>';
}echo '
    </ul>
</div>';

echo'
<!-- Modal -->
<div class="modal" id="ModalEliminar" tabindex="-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            
        </div>
    </div>
</div>';

echo'
<!-- Modal -->
<div class="modal " id="ModalRecuperar" tabindex="-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            
        </div>
    </div>
</div>';