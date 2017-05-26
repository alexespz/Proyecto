function modificarPerfil(){
  $('#listadoProductos').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("../consultas/listadoProductos.php");
  });
}
