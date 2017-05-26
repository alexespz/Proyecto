<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_SESSION["usuario"])){
  header("Location: ../paginas/paginaAdministrador.php");
}

$query = "SELECT id_tipo_producto, nombre FROM tipo_producto";
$conexion->consultas();
echo '<table class="table table-striped col-md-9">
  <tr>
    <td class="col-md-1">id</td>
    <td class="col-md-3">Nombre</td>
    <td class="col-md-2">Acciones</td>
  </tr>
  <tr>';
while($conexion->devolverFilas()){
  echo '<td>' .$resultado["id_tipo_producto"]. '</td>
    <td>' .$resultado["nombre"]. '</td>
    <td>' .$resultado["descripcion"]. '</td>
    <td><button class="btn btn-info" href="../consultas/modificarTipoProducto.php?id='.$resultado["id_tipo_producto"].'"><span class="glyphicon glyphicon-pencil"></span></button>
        <button class="btn btn-danger" href="../consultas/eliminarTipoProducto.php?id='.$resultado["id_tipo_producto"].'"><span class="glyphicon glyphicon-trash"></span></button>
    </td>
  </tr>';
}
echo '</table>';
echo 'Resultados obtenidos: ' .$conexion->numFilas();
