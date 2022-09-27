<?php

class Compra extends Model{
    public $codigoCompra;
    public $emision ;
    public $codigoProveedor ;
    public $codigoUsuario ;
    public $detalle;

    function __construct(){
        parent::__construct();
    }

    public function insert(){
        // insertar datos en la BD
        $conn = $this->db->connect();
        try{
            $conn->beginTransaction();

            $query = $conn->prepare('INSERT INTO compra(codigoCom ,fechaEmisión, codigoPro, codigoUsu) 
                                    values (:codigo, :fecha, :proveedor, :usuario)');
            $query->execute([
                            'codigo' => $this->codigoCompra,                            
                            'fecha' => $this->emision,
                            'proveedor' => $this->codigoProveedor,
                            'usuario' => $this->codigoUsuario
                    ]);

           
            foreach ($this->detalle as $row) {
                $query = $conn->prepare('INSERT INTO detallecompra(codigo,codigoSol,codigoCom,cantidad) 
                                    values (:presentacion, :codigosol,:compra, :cantidad)');
                $query->execute([
                        'compra' => $this->codigoCompra,                            
                        'presentacion' => $row->codigoPresentacion,
                        'cantidad' => $row->cantidad,
                        'codigosol' => $row->codigoSolicitud
                ]);                
            }
            
            $conn->commit();
            return true;
        }catch(PDOException $e){
            $conn->rollback();
            // var_dump($e);
            return false;
        }
    }

    public function update(){

    }

    public function delete(){

    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT c.codigoCom CodCompra, date_format(c.fechaEmisión, '%d/%m/%Y') Emision,
                                                    pv.nombre Proveedor, us.login Usuario
                                                    FROM compra c 
                                                    INNER JOIN proveedor pv ON pv.codigoPro = c.codigoPro
                                                    INNER JOIN usuario us on us.codigo = c.codigoUsu
                                                    ORDER BY c.fechaEmisión DESC");
            while($row = $query->fetch()){
                array_push($items,[
                    'CodCompra' => $row['CodCompra'],
                    'Emision' => $row['Emision'],
                    'Proveedor' => $row['Proveedor'],
                    'Usuario' => $row['Usuario']
                ]);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function get($id){
        $items = [];
        try{
            $query = $this->db->connect()->prepare("SELECT c.codigoCom CodCompra, date_format(c.fechaEmisión, '%d/%m/%Y') Emision,
                                                    dc.cantidad Cantidad, pro.nombre Producto, u.nombre Unidad, pv.nombre Proveedor,
                                                    us.login Usuario,dc.codigoSol as CodSolicitud
                                                    FROM compra c 
                                                    INNER JOIN detallecompra dc ON c.codigoCom = dc.codigoCom                                             
                                                    INNER JOIN presentacion p ON p.codigo = dc.codigo                                           
                                                    INNER JOIN producto pro ON pro.codigo = p.codigoProd                                           
                                                    INNER JOIN unidad u ON u.codigo = p.codigoUnidad   
                                                    INNER JOIN proveedor pv ON pv.codigoPro = c.codigoPro
                                                    INNER JOIN usuario us on us.codigo = c.codigoUsu
                                                    WHERE c.codigoCom = :codigoCompra;");
            $query->execute([
                'codigoCompra' => $id
            ]);

            while($row = $query->fetch()){
                array_push($items,[
                    'CodCompra' => $row['CodCompra'],
                    'Emision' => $row['Emision'],
                    'Cantidad' => $row['Cantidad'],
                    'Producto' => $row['Producto'],
                    'Unidad' => $row['Unidad'],
                    'Proveedor' => $row['Proveedor'],
                    'Usuario' => $row['Usuario'],
                    'CodSolicitud' => $row['CodSolicitud'],
                ]);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getLastSol(){
        $items = null;

        try{

            $query = $this->db->connect()->query("SELECT count(*) as total FROM compra");

            while($row = $query->fetch()){
                $total = $row["total"];
                $items = "C00" . (intval($total)+1);
            }

            return $items;
        }catch(PDOException $e){
            return null;
        }
    }

    public function getProveedor()
    {
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM proveedor");
            while($row = $query->fetch()){
                array_push($items, [
                    'CodProveedor'  => $row['codigoPro'],
                    'Proveedor'     => $row['nombre']
                ]);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
}

?>