function modificarPerfil(){
  $('#listadoProductos').on("click", function(e){
        e.preventDefault();
        $('#cuerpo').load("listadoProductos.php");
  });
  
  $('#nuevosProductos').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("aniadirProductos.php");
  });
  
  $('#listadoTipos').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("listadoTiposProductos.php");
  });
  
  $('#nuevosTipos').on('click', function(e){
        e.preventDefault();
        $('#cuerpo').load("aniadirTipoProducto.php");
  });
}
