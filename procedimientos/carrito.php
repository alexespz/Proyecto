<?php
class Carrito {
    private $carrito = array();

    //seteamos el carrito exista o no exista en el constructor
    public function __construct(){
        if(!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = null;
            $this->carrito["precio_total"] = 0;
            $this->carrito["articulos_total"] = 0;
        }
        $this->carrito = $_SESSION['carrito'];
    }

    //añadimos un producto al carrito
    public function add($articulo = array()){
        //debemos crear un identificador único para cada producto
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $codigo = array();
        $longitud = strlen($alphabet) - 1;
        for ($i = 0; $i < 5; $i++) {
            $cod = rand(0, $longitud);
            $codigo[] = $alphabet[$cod];
        }
        //$codigoPedido = implode($codigo); //devolvemos el array convertido a string
        $unique_id = md5($articulo["id"]);

        //creamos la id única para el producto
        $articulo["unique_id"] = $unique_id;

        //si no está vacío el carrito lo recorremos
        if(!empty($this->carrito)) {
            foreach ($this->carrito as $producto) {
                //comprobamos si el producto ya estaba en el carrito para actualizar el producto o insertar un nuevo producto
                if($producto["unique_id"] === $unique_id) {
                    //si ya estaba sumamos la cantidad
                    $articulo["cantidad"] += $producto["cantidad"];
                }
            }
        }

        //añadimos un elemento total al array carrito para saber el precio total de la suma de este artículo
        $articulo["total"] = $articulo["cantidad"] * $articulo["precio"];

        //primero debemos eliminar el producto si es que estaba en el carrito
        $this->unset_producto($unique_id);

        ///ahora añadimos el producto al carrito
        $_SESSION["carrito"][$unique_id] = $articulo;

        //actualizamos el carrito
        $this->update_carrito();

        //actualizamos el precio total y el número de artículos del carrito una vez hemos añadido el producto
        $this->update_precio_cantidad();

    }

    //método para actualizar el precio total y la cantidad de productos total del carrito
    private function update_precio_cantidad() {
        //seteamos las variables precio y artículos a 0
        $precio = 0;
        $articulos = 0;

        //recorrecmos el contenido del carrito para actualizar el precio total y el número de artículos
        foreach ($this->carrito as $producto) {
            $precio += ($producto['precio'] * $producto['cantidad']);
            $articulos += $producto['cantidad'];
        }

        //asignamos a articulos_total el número de artículos actual y al precio el precio actual
        $_SESSION['carrito']["articulos_total"] = $articulos;
        $_SESSION['carrito']["precio_total"] = $precio;

        //refrescamos él contenido del carrito para que quedé actualizado
        $this->update_carrito();
    }

    //método que retorna el precio total del carrito
    public function precio_total(){
        //si no está definido el elemento precio_total o no existe el carrito el precio total será 0
        if(!isset($this->carrito["precio_total"]) || $this->carrito === null) {
            return 0;
        }

        //en otro caso devolvemos el precio total del carrito
        return $this->carrito["precio_total"] ? $this->carrito["precio_total"] : 0;
    }

    //método que retorna el número de artículos del carrito
    public function articulos_total() {
        //si no está definido el elemento articulos_total o no existe el carrito el número de artículos será de 0
        if(!isset($this->carrito["articulos_total"]) || $this->carrito === null) {
            return 0;
        }

        //en otro caso devolvemos el número de artículos del carrito
        return $this->carrito["articulos_total"] ? $this->carrito["articulos_total"] : 0;
    }

    //este método retorna el contenido del carrito
    public function get_content() {
        //asignamos el carrito a una variable
        $carrito = $this->carrito;
        //debemos eliminar del carrito el número de artículos y el precio total para poder mostrar bien los artículos ya que estos datos los devuelven los métodos articulos_total y precio_total
        unset($carrito["articulos_total"]);
        unset($carrito["precio_total"]);
        return $carrito == null ? null : $carrito;
    }

    //método que llamamos al insertar un nuevo producto al carrito para eliminarlo si existia, así podemos insertarlo de nuevo pero actualizado
    private function unset_producto($unique_id){
        unset($_SESSION["carrito"][$unique_id]);
    }

    //para eliminar un producto debemos pasar la clave única que contiene cada uno de ellos
    public function remove_producto($unique_id) {
        //si no existe el carrito
        if($this->carrito === null) {
            throw new Exception("El carrito no existe!", 1);
        }

        //si no existe la id única del producto en el carrito
        $carro = $this->get_content();
        foreach ($carro as $producto){
            if($producto["id"] == $unique_id){
                unset($_SESSION["carrito"][$producto["unique_id"]]);
                $this->update_carrito();
                $this->update_precio_cantidad();
            }
        }

        return true;
    }

    //eliminamos el contenido del carrito por completo
    public function destroy(){
        unset($_SESSION["carrito"]);
        $this->carrito = null;
        return true;
    }

    //actualizamos el contenido del carrito
    public function update_carrito(){
        self::__construct();
    }

}