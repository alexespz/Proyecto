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

echo '<table class="table table-striped col-md-10">
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
            echo '<td><input type="checkbox" disabled data-toggle="toggle" data-size="mini" data-onstyle="success" data-offstyle="danger" data-on=" " data-off=""></td>';
        }else{
            echo '<td><input type="checkbox" disabled checked data-toggle="toggle" data-size="mini" data-onstyle="success" data-offstyle="danger" data-on=" " data-off=" "></td>';
        }echo'
        <td>' .$resultado["nombre"]. '</td>
        <td>' .$resultado["descripcion"]. '</td>
        <td><button class="btn btn-info" href="../admin/modificarProducto.php?id='.$resultado["id_producto"].'"><span class="glyphicon glyphicon-pencil"></span></button>
            <button class="btn btn-danger" href="../admin/eliminarProducto.php?id='.$resultado["id_producto"].'"><span class="glyphicon glyphicon-trash"></span></button>
        </td>
    </tr>';
}
echo '</table>';
echo 'Resultados obtenidos: ' .$conexion->numFilas();