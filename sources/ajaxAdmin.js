function modificarPerfil(){
  $('#listadoProductos').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("listadoProductos.php");
  });
}
