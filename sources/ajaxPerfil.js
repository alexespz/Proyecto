$(document).ready(function(){
  $('#cuerpo').load('consultarPerfil.php');
});

function modificarPerfil(){
  $('#editarPerfil').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("modificarPerfil.php");
  });
}

function modificarContrasena(){
  $('#cambiarContrasena').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("modificarContrasena.php");
  });
}

function verPerfil(){
  $('#verPerfil').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("consultarPerfil.php");
  });
}
