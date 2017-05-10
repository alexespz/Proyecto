<?php
include_once '../procedimientos/procedimientos.php';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';

$conexion = new procedimientos();
$conexion->conect();

$obtenerProductos = "SELECT * FROM producto WHERE tipo_producto = ?";
$sentenciaProductos = $conexion->consultasPreparadas($obtenerProductos);
$sentenciaProductos->bind_Param('s', $tipo);
$variable = '<script> 
$(window).ready(function(){
    document.write($(".tab-pane.active").attr("id"));
});
</script>';
echo $variable;
switch($tipo){
    case 'entrantes':
        $tipo = '1';
        break;
    case 'ensaladas':
        $tipo = '2';
        break;
    case 'carnes':
        $tipo = '3';
        break;
    case 'pescados':
        $tipo = '4';
        break;
    case 'bebidas':
        $tipo = '5';
        break;
    case 'postres':
        $tipo = '6';
        break;
}



