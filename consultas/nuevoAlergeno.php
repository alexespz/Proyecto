<?php
session_start();
include_once '../procedimientos/procedimientos.php';

$conexion = new procedimientos();
$conexion->conect();

if(!isset($_POST["foto"])){
    $carpeta = "../imagenes/alergenos/";
    $tipoImagen = $_FILES["foto"]["type"];

    if(file_exists($carpeta . $_FILES["foto"]["name"])){
        echo '<script>$.growl.error({ message: "Ya existe una imagen con ese nombre" });</script>';
    }else if (strlen($_FILES["foto"]["name"]) > 30){
        echo '<script>$.growl.error({ message: "El nombre del archivo es demasiado largo" });</script>';
    }else if(($_FILES['foto']['type'] != "image/jpg") && ($_FILES['foto']['type'] != "image/png") && ($_FILES['foto']['type'] != "image/jpeg")){
        echo '<script>$.growl.error({ message: "Extensión del archivo incorrecta" });</script>';
    }
    copy($_FILES['foto']['tmp_name'], $carpeta . $_FILES['foto']['name']);
    $imagen = $_FILES['foto']['name'];
}

if(isset($_POST["foto"])){
    $imagen = 'NULL';
}

$query = "INSERT INTO alergeno VALUES('','".$_POST["nombre"]."', '".$imagen."', 0)";
$conexion->consultas($query);

if($conexion->filasAfectadas() > 0){
    echo '
        <script>
            $.growl.notice({ message: "Alergeno añadido" });
            setTimeout(function(){
                $("#cuerpo").load("listadoAlergenos.php");
            }, 2000);
        </script>';
}else{
    echo '<script>$.growl.error({ message: "Se ha producido un error. Vuelva a intentarlo" });</script>';
}