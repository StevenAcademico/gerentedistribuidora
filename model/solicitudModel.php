<?php

class Solicitud extends Model{
    public $codigo;
    public $fecha;

    function __construct(){
        parent::__construct();
    }

    public function insert(){
        // insertar datos en la BD
        $conn = $this->db->connect();
        try{
            $conn->beginTransaction();

            $query = $conn->prepare('INSERT INTO solicitud(codigoSol ,fechaEmision) 
                                    values (:codigo, :fecha)');
            $query->execute([
                            'codigo' => $this->codigo,                            
                            'fecha' => $this->fecha
                    ]);

           
            foreach ($this->detalles as $row) {
                $detalle = new DetalleSolicitud();
                $detalle = $row;
                $query = $conn->prepare('INSERT INTO detallesolicitud(codigo,codigoSol,cantidadSolicitada) 
                                    values (:codigo, :codigosol,:cantidad)');
                $query->execute([
                        'codigosol' => $this->codigo,                            
                        'codigo' => $detalle->presentacion,
                        'cantidad' => $detalle->cantidadSolicitada
                ]);                
            }
            
            $conn->commit();
            return true;
        }catch(PDOException $e){
            $conn->rollback();
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

            $query = $this->db->connect()->query("SELECT * FROM solicitud  order by fechaEmision desc");

            while($row = $query->fetch()){
                $item = new Solicitud();
                $item->codigo = $row['codigoSol'];
                $item->fecha    = $row['fechaEmision'];
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getLastSol(){
        $items = null;

        try{

            $query = $this->db->connect()->query("SELECT count(*) as total FROM solicitud");

            while($row = $query->fetch()){
                $total = $row["total"];
                $items = "S00" . (intval($total)+1);
            }

            return $items;
        }catch(PDOException $e){
            return null;
        }
    }

    public function getById($id){
        $items = [];

        try{

            $query = $this->db->connect()->prepare("SELECT * FROM solicitud");

            $query->execute([
                "codigo" => $id
            ]);

            while($row = $query->fetch()){
                $item = new Solicitud();
                $item->codigo = $row['codigoSol'];
                $item->fecha    = $row['fechaEmision'];
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getProductoSolicitar()
    {
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT pre.descripcion Presentacion,pre.codigo CodPresentacion,pro.nombre Producto,
                                                    SUM(dp.cantidad) CantidadRequerida,pre.cantidad Stock, u.nombre
                                                    FROM presentacion as pre INNER JOIN producto as pro ON pro.codigo = pre.codigoProd
                                                    INNER JOIN unidad as u ON u.codigo
                                                    INNER JOIN detallepedido as dp ON pre.codigo = dp.codigoPre
                                                    GROUP by pre.codigo = pre.codigoUnidad
                                                    HAVING SUM(dp.cantidad) > pre.cantidad;");

            while($row = $query->fetch()){
                array_push($items,[
                    'Presentacion' => $row['Presentacion'],
                    'CodPresentacion' => $row['CodPresentacion'],
                    'Producto' => $row['Producto'],
                    'CantidadRequerida' => $row['CantidadRequerida'],
                    'CantidadSolicitar' => $row['CantidadRequerida'],
                    'Stock' => $row['Stock'],
                    'nombre' => $row['nombre']
                ]);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getSolicitud($id)
    {
        $items = [];

        try{

            $query = $this->db->connect()->prepare("SELECT so.codigoSol CodSolicitud, date_format(so.fechaEmision, '%d/%m/%Y') Emision,
                                                    ds.cantidadSolicitada Cantidad, pro.nombre Producto, u.nombre Unidad,
                                                    (ds.cantidadSolicitada - ( SELECT IF(SUM(dc.cantidad) IS NULL, 0, SUM(dc.cantidad)) FROM detallecompra dc 
                                                                                WHERE dc.codigoSol=so.codigoSol AND dc.codigo = p.codigo )) as FaltaSolicitar,
                                                    CONCAT(ds.codigoSol,p.codigo) CodDetalle,p.codigo as CodPresentacion	 
                                                    FROM solicitud so 
                                                    INNER JOIN detallesolicitud ds ON so.codigoSol = ds.codigoSol 
                                                    INNER JOIN presentacion p ON p.codigo = ds.codigo
                                                    INNER JOIN producto pro ON pro.codigo = p.codigoProd
                                                    INNER JOIN unidad u ON u.codigo = p.codigoUnidad
                                                    WHERE so.codigoSol = :codigosol;");
            $query->execute([
                'codigosol' => $id
            ]);

            while($row = $query->fetch()){
                array_push($items,[
                    'CodSolicitud' => $row['CodSolicitud'],
                    'Emision' => $row['Emision'],
                    'Cantidad' => $row['Cantidad'],
                    'Producto' => $row['Producto'],
                    'Unidad' => $row['Unidad'],
                    'FaltaSolicitar' => $row['FaltaSolicitar'],
                    'CodDetalle' => $row['CodDetalle'],
                    'CodPresentacion'=>$row['CodPresentacion']
                ]);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

}

?>