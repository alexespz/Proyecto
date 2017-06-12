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

$sql = "SELECT * FROM producto ORDER BY id_producto ASC LIMIT ".$start_from.", ".$results_per_page;
$conexion->consultas($sql);

echo '
<script>
    $(function() {
        $("input:checkbox").bootstrapToggle();
    });
    
    function modificarProducto(id){
        $.ajax({
            async: true,
            type: "POST",
            url: "../admin/modificarProducto.php",
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
            url: "../admin/listadoProductos.php",
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
            url: "../admin/listadoProductos.php",
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
            url: "../admin/listadoProductos.php",
            data: "pagina=" + page,
            success: function (resp) {
                $("#cuerpo").html(resp);
            }
        });
    }
</script>

<table class="table table-striped table-responsive col-md-10">
    <tr>
        <td class="col-md-1">ID</td>
        <td class="col-md-1">Activo</td>
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
            <button type="button" class="btn btn-info" onclick="modificarProducto('.$resultado["id_producto"].')"><span class="glyphicon glyphicon-pencil"></span></button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar" href="../consultas/confirmarEliminarProducto.php?id='.$resultado["id_producto"].'"><span class="glyphicon glyphicon-trash"></span></button>';
        }else{ echo '
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalRecuperar" href="../consultas/confirmarRecuperarProducto.php?id='.$resultado["id_producto"].'"><span class="glyphicon glyphicon-refresh"></span></button>';
        }echo '
        </td>
    </tr>';
}
echo '</table>';
echo 'Resultados obtenidos: ' .$conexion->numFilas();
echo "<br/>";

$sql = "SELECT COUNT(id_producto) AS total FROM producto";
$conexion->consultas($sql);
$resultado = $conexion->devolverFilas();

$total_pages = ceil($resultado["total"] / $results_per_page);
echo '
<div class="text-center">
    <ul class="pagination">
        <li class="page-item">
              <a class="page-link" onclick="primeraPagina(1)" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>';
for ($i=1; $i<=$total_pages; $i++){
    if($page == $i){
        echo '<li class="page-item active"><a onclick="pagina('.$i.')">' . $i . '</a></li>';
    }else {
        echo '<li class="page-item"><a onclick="pagina('.$i.')">' . $i . '</a></li>';
    }
}echo '
        <li class="page-item">
            <a class="page-link" onclick="ultimaPagina('.$total_pages.')" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
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
<div class="modal" id="ModalRecuperar" tabindex="-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            
        </div>
    </div>
</div>';
