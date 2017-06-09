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

$sql = "SELECT * FROM usuarios ORDER BY id_usuario ASC LIMIT ".$start_from.", ".$results_per_page;
$conexion->consultas($sql);

echo '
<script>
    $(function() {
        $("input:checkbox").bootstrapToggle();
    });
    
    function primeraPagina(page){
        $.ajax({
            async: true,
            type: "POST",
            url: "../admin/listadoUsuarios.php",
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
            url: "../admin/listadoUsuarios.php",
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
            url: "../admin/listadoUsuarios.php",
            data: "pagina=" + page,
            success: function (resp) {
                $("#cuerpo").html(resp);
            }
        });
    }
</script>

<table class="table table-striped table-responsive col-md-12">
    <tr>
        <td class="col-md-1">ID</td>
        <td class="col-md-3">Nombre completo</td>
        <td class="col-md-1">DNI</td>
        <td class="col-md-1">Telefono</td>
        <td class="col-md-2">Usuario</td>
        <td class="col-md-2">E-mail</td>
        <td class="col-md-2">Acciones</td>
    </tr>
    <tr>';
while($resultado = $conexion->devolverFilas()){
    echo '<td>' .$resultado["id_usuario"]. '</td>
        <td>' .$resultado["nombre"].' '.$resultado["apellidos"].'</td>
        <td>' .$resultado["dni"]. '</td>
        <td>' .$resultado["telefono"]. '</td>
        <td>' .$resultado["usuario"]. '</td>
        <td>' .$resultado["email"].' </td>
        <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar" href="../consultas/confirmarEliminarUsuario.php?id='.$resultado["id_usuario"].'"><span class="glyphicon glyphicon-trash"></span></button>
        </td>
    </tr>';
}
echo '</table>';
echo 'Resultados obtenidos: ' .$conexion->numFilas();
echo "<br/>";

$sql = "SELECT COUNT(id_usuario) AS total FROM usuarios";
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