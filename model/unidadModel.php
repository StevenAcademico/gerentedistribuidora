<?php

class Unidad extends Model{
    public $codigo;
    public $unidad;
    public $nombre;
    public $equivalencia;

    function __construct(){
        parent::__construct();
    }


    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM unidad");

            while($row = $query->fetch()){
                $item = new Unidad();
                $item->codigo = $row['codigo'];
                $item->nombre    = $row['nombre'];
                $item->unidad = new Unidad();
                $item->unidad->codigo  = $row['codigoUni'];
                $item->equivalencia = $row['equivalencia'];

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getUnidadByProductYPresentacion($producto,$presentacion){
        $items = [];

        try{

            $query = $this->db->connect()->prepare("SELECT u.codigo,u.nombre
                                                    from unidad u 
                                                    inner join presentacion p on p.codigoUnidad = u.codigo
                                                    where p.codigoProd = :producto and p.codigo = :presentacion");

            $query->execute([
                "producto" => $producto,
                "presentacion" => $presentacion
            ]);

            while($row = $query->fetch()){
                $item = new Unidad();
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