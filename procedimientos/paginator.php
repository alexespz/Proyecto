<?php
include_once 'procedimientos.php';

class paginator{
    private $rec_per_page;
    private $page;
    private $start_from;

    private $conexion;

    public function __construct(){
        if(!isset($_GET["page"])){
            $this->page = 1;
        }else{
            $this->page = $_GET["page"];
        }
        $this->rec_per_page = 10;
        $this->start_from = ($this->page - 1) * $this->rec_per_page;
    }

    public function getData($nombreTabla){
        $this-> conexion = new procedimientos();
        $this->conexion->conect();
        $query = "SELECT * FROM ".$nombreTabla." LIMIT ".$this->start_from.", ".$this->rec_per_page." ";

        $this->conexion->consultas($query);
        return $this->conexion->devolverFilas();
    }

    public function pintarPaginacion($nombreTabla){
        $this->conexion = new procedimientos();
        $this->conexion->conect();
        $query = "SELECT * FROM ".$nombreTabla." ";

        $this->conexion->consultas($query);
        $totalRegistros = $this->conexion->numFilas();
        $totalPaginas = ceil($totalRegistros / $this->rec_per_page);

        echo "<a href='listadoTiposProductos.php?page=1'>".'|<'."</a> "; // Goto 1st page
        for($i = 0; $i < $totalPaginas; $i++){
            echo "<a href='listadoTiposProductos.php?page=".$i."'>".$i."</a> ";
        };
        echo "<a href='listadoTiposProductos.php?page=".$totalPaginas."'>".'>|'."</a> "; // Goto last page
    }
}