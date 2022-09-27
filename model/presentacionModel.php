<?php

require_once "model/productoModel.php";
require_once "model/unidadModel.php";

class Presentacion extends Model{
    public $codigo;
    public $producto;
    public $descripcion;
    public $precio;
    public $cantidad;
    public $disponible;
    public $unidad;

    function __construct(){
        parent::__construct();
    }

    public function insert(){
        // insertar datos en la BD
        try{
            $query = $this->db
                        ->connect()
                        ->prepare('INSERT INTO presentacion(codigoProd ,descripcion,precio,cantidad,codigoUnidad) 
                                    values (:producto, :descripcion, :precio,:cantidad,:unidad)');
            $query->execute([
                            'descripcion' => $this->descripcion,                            
                            'precio' => $this->precio,
                            'cantidad' => $this->cantidad,                            
                            'producto' => $this->producto->codigo,
                            'unidad' => $this->unidad->codigo
                    ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function update(){

    }

    public function delete(){

    }

    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM presentacion");

            while($row = $query->fetch()){
                $item = new Presentacion();
                $item->codigo = $row['codigo'];
                $item->descripcion    = $row['descripcion'];
                $item->disponible  = $row['disponible'];
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getPresentacionDetail(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT p.codigo,p.descripcion as presentacion, pr.nombre as producto, p.cantidad as stock,
                                                    u.nombre as unidad
                                                    FROM presentacion p 
                                                    INNER JOIN producto pr on pr.codigo = p.codigoProd
                                                    INNER JOIN unidad u on u.codigo = p.codigoUnidad
                                                    WHERE p.disponible = 1");


            while($row = $query->fetch()){
                $item = new Presentacion();
                $item->codigo = $row['codigo'];
                $item->descripcion = $row['presentacion'];
                $item->disponible  = 1;
                $item->cantidad = $row["stock"];
                $item->producto = new Producto();
                $item->producto->nombre = $row["producto"];
                $item->unidad = new Unidad();
                $item->unidad->nombre = $row["unidad"];
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getActivosByProducto($producto){
        $items = [];

        try{

            $query = $this->db->connect()->prepare("SELECT * FROM presentacion 
                                                    where disponible=1 and codigoProd= :producto");

            $query->execute([
                'producto' => $producto
            ]);


            while($row = $query->fetch()){
                $item = new Presentacion();
                $item->codigo = $row['codigo'];
                $item->descripcion    = $row['descripcion'];
                $item->disponible  = $row['disponible'];
                $item->precio = $row["precio"];
                $item->cantidad = $row["cantidad"];
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

}

?>