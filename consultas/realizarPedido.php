<?php
include_once '../procedimientos/procedimientos.php';
include_once '../consultas/aniadirProducto.php';

$conexion = new procedimientos();
$conexion->conect();

for($i=0; $i<count($carrito); $i++){
  $query = "INSERT INTO pedido VALUES"
}
