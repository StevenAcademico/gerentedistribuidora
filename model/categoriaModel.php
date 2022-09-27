<?php

class Categoria extends Model{
    public $codigo;
    public $nombre;

    function __construct(){
        parent::__construct();
    }


    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM categoria");

            while($row = $query->fetch()){
                $item = new Categoria();
                $item->codigo = $row['codigo'];
                $item->nombre    = $row['nombre'];
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    

}

?>