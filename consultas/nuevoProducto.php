<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

$carpeta = "../imagenes/productos/";
$tipoImagen = $_FILES["foto"]["type"];

if(file_exists($carpeta . $_FILES["foto"]["name"])){
  echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Ya existe una imagen con ese nombre</span>';
}else if (strlen($_FILES["foto"]["name"]) > 30){
  echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> El nombre del archivo es demasiado largo</span>';
}else if(($_FILES['foto']['type'] != "image/jpg") && ($_FILES['foto']['type'] != "image/png")){
  echo '<span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> Extension de archivo incorrecto</span>';
}else{
  copy($_FILES['foto']['tmp_name'], $carpeta . $_FILES['foto']['name']);
  
  $descriptor = fopen($_FILES['foto']['tmp_name'], 'r+');
	$contenido = fread($descriptor, filesize($_FILES['foto']['tmp_name']));
	fclose($descriptor);
  
  $imagen = $conexion->escape_string($contenido);
  if($_POST["descripcion"] == ""){
      $_POST["descripcion"] = NULL;
  }
  if($_POST["calorias"] == ""){
      $_POST["calorias"] = NULL;
  }
  if($_POST["foto"] == ""){
      $_POST["foto"] = NULL;
  }
  
  $query = "INSERT INTO producto VALUES('','".$_POST["nombre"]."', '".$_POST["descripcion"]."', ".$_POST["precio"].", '".$imagen."', ".$_POST["calorias"].", ".$_POST["tipo"]." )";
}
