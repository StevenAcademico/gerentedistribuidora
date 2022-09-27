<?php

class Rol extends Model{
    public $codigo;
    public $nombre;

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

            $query = $this->db->connect()->query("SELECT * FROM rolusuario");

            while($row = $query->fetch()){
                $item = new Rol();
                $item->codigo = $row['codigo'];
                $item->nombre    = $row['nombre'];
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