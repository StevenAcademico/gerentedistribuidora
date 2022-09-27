<?php
    require_once "model/categoriaModel.php";

class Producto extends Model{
    public $codigo;
    public $categoria;
    public $nombre;
    public $disponible;

    function __construct(){
        parent::__construct();
    }

    public function insert(){
    }

    public function update(){
    }

    public function delete(){
    }

    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT p.codigo as codproducto,p.nombre as producto,p.disponible,c.nombre as categoria,
                                                    c.codigo as codcategoria
                                                    from producto p 
                                                    inner join categoria c on c.codigo = p.codigoCat");


            while($row = $query->fetch()){
                $item = new Producto();
                $item->codigo = $row['codproducto'];
                $item->nombre = $row['producto'];
                $item->disponible    = $row['disponible'];
                $item->categoria  = new Categoria();
                $item->categoria->codigo = $row['codcategoria'];
                $item->categoria->nombre = $row['categoria'];

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }


    public function getProductByCategoria($codcategoria){
        $items = [];

        try{

            $query = $this->db->connect()->prepare("SELECT p.codigo as codproducto,p.nombre as producto
                                                    from producto p 
                                                    WHERE codigoCat = :categoria and disponible = 1");
            
            $query->execute([
                'categoria' => $codcategoria
        ]);


            while($row = $query->fetch()){
                $item = new Producto();
                $item->codigo = $row['codproducto'];
                $item->nombre = $row['producto'];
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id){
    }

    



}

?>