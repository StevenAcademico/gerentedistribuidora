<?php

class Cliente extends Model{
    public $codigo;
    public $ruc;
    public $nombre;
    public $celular;
    public $direccion;
    public $correo;

    function __construct(){
        parent::__construct();
    }

    public function insert(){
        // insertar datos en la BD

    }

    public function update(){

    }

    public function delete(){

    }

    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM cliente");

            while($row = $query->fetch()){
                $item = new Cliente();
                $item->idcliente = $row['codigo'];
                $item->ruc    = $row['ruc'];
                $item->nombre  = $row['nombre'];
                $item->celular = $row['celular'];
                $item->direccion = $row['direccion'];
                $item->correo = $row['correo'];

                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id){
        $item = new Cliente();

        $query = $this->db->connect()->prepare("SELECT * FROM cliente WHERE idcliente = :idcliente");
        try{
            $query->execute(['idcliente' => $id]);

            while($row = $query->fetch()){
                $item->idcliente = $row['idcliente'];
                $item->dni    = $row['dni'];
                $item->nombre  = $row['nombre'];
                $item->telefono = $row['telefono'];
                $item->direccion = $row['direccion'];
                $item->usuario_id = $row['usuario_id'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function getLastId(){

    }

    public function getByRuc($ruc){

    }




}

?>