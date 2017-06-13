<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_POST["foto"])){
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
  if($_POST["foto"] == "undefined"){
      $imagen = 'NULL';
  }
  
  $query = "INSERT INTO producto VALUES('','".$_POST["nombre"]."', '".$_POST["descripcion"]."', ".$_POST["precio"].", '".$imagen."', ".$_POST["calorias"].", ".$_POST["tipo"].", 0 )";
  $conexion->consultas($query);

  if($conexion->filasAfectadas() > 0){
      echo '
            <script>
                $.growl.notice({ message: "Producto añadido" });
                setTimeout(function(){
                    $("#cuerpo").load("listadoProductos.php");
                }, 2000);
            </script>';
  }else{
      echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';
  }

  $lastId = $conexion->ultimoId();
  $query = "";
  if($_POST["alergeno1"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 1);";
  }
  if($_POST["alergeno2"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 2);";
  }
  if($_POST["alergeno3"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 3);";
  }
  if($_POST["alergeno4"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 4);";
  }
  if($_POST["alergeno5"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 5);";
  }
  if($_POST["alergeno6"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 6);";
  }
  if($_POST["alergeno7"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 7);";
  }
  if($_POST["alergeno8"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 8);";
  }
  if($_POST["alergeno9"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 9);";
  }
  if($_POST["alergeno10"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 10);";
  }
  if($_POST["alergeno11"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 11);";
  }
  if($_POST["alergeno12"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 12);";
  }
  if($_POST["alergeno13"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 13);";
  }
  if($_POST["alergeno14"] == "true"){
      $query .= "INSERT INTO producto_alergeno VALUES ('', ".$lastId.", 14);";
  }
  $conexion->multiConsultas($query);

