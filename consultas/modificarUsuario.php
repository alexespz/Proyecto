<?php
session_start();
include_once '../procedimientos/procedimientos.php';
$conexion = new procedimientos();
$conexion->conect();

$sql = "UPDATE usuarios SET usuario = "'.$_POST["usuarioNuevo"].'" WHERE usuario = "'.$_POST["usuarioAntiguo"].'";
$conexion->consultas($sql);
if($conexion->filasAfectadas() > 0){
  <span class="col-md-12 alert alert-info" id="mensaje"><p class="fa fa-info-circle"></p> Usuario modificado</span>
  <script>
      setTimeout(function(){
          $('#cuerpo').load('consultarPerfil.php');
      }, 1200);
  </script>';
}else{
  <span class="alert alert-danger" id="mensaje"><p class="fa fa-exclamation-triangle"></p> El usuario y/o contraseña son incorrectos, vuelva a intentarlo.</span>';
}
