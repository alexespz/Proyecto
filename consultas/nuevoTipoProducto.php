<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$query = "INSERT INTO tipo_producto VALUES('','".$_POST["nombre"]."')";
}
