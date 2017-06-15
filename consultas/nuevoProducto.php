<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(isset($_FILES["foto"])){
    $carpeta = "../imagenes/productos/";
    $tipoImagen = $_FILES["foto"]["type"];

    if(file_exists($carpeta . $_FILES['foto']['name'])){
        echo '<script>$.growl.error({ message: "Ya existe una imagen con ese nombre" });</script>';
    }else if (strlen($_FILES['foto']['name']) > 30){
        echo '<script>$.growl.error({ message: "El nombre del archivo es demasiado largo" });</script>';
    }else if(($_FILES['foto']['type'] != "image/jpg") && ($_FILES['foto']['type'] != "image/png") && ($_FILES['foto']['type'] != "image/jpeg")){
        echo '<script>$.growl.error({ message: "Extensión del archivo incorrecta" });</script>';
    }
    copy($_FILES['foto']['tmp_name'], $carpeta . $_FILES['foto']['name']);
    $imagen = $_FILES['foto']['name'];
}

  if($_POST["descripcion"] == ""){
      $_POST["descripcion"] = 'NULL';
  }
  if($_POST["calorias"] == ""){
      $_POST["calorias"] = 'NULL';
  }
  if($_FILES["foto"] == "undefined"){
      $imagen = 'NULL';
  }
  
  $query = "INSERT INTO producto VALUES('','".$_POST["nombre"]."', '".$_POST["descripcion"]."', ".$_POST["precio"].", '".$imagen."', ".$_POST["calorias"].", ".$_POST["tipo"].", 0 )";
  $conexion->consultas($query);

  $lastId = $conexion->ultimoId();
  for($i=0; $i<= count($_POST["alergeno"])-1; $i++){
      if($_POST["alergeno"][$i] != NULL){
          $query = "INSERT INTO producto_alergeno(id_producto, id_alergeno)VALUES (".$lastId.", ".$_POST["alergeno"][$i].")";
          $conexion->consultas($query);
      }
  }

  header("Location: ../admin/menuAdmin.php");
