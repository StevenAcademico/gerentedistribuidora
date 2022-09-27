<?php
require_once "model/detallePedidoModel.php";
require_once "model/presentacionModel.php";
require_once "model/unidadModel.php";
require_once "model/productoModel.php";

class Pedido extends Model{
    public $numero;
    public $fecha;
    public $estado;
    public $pagado;
    public $direccion;
    public $cliente;
    public $fechaEntrega;
    public $referencia;
    public $telefono;
    public $usuario;
    public $importe;
    public $detalles = [];

    function __construct(){
        parent::__construct();
    }

    public function insert(){
        // insertar datos en la BD
        $conn = $this->db->connect();
        
        try{
            $conn->beginTransaction();
            $query = $conn->prepare('INSERT INTO pedido(direccionEnt,codigoCli,fechaEnt,
                                                        referenciaEnt,telefonoEnt,codigoUsu) 
                                    values (:direccion,:cliente,:fecha,:referencia,
                                            :telefono,:usuario)');
            $query->execute([
                            'direccion' => $this->direccion,
                            'cliente' => $this->cliente->codigo,                            
                            'fecha' => $this->fechaEntrega,
                            'referencia' => $this->referencia,
                            'telefono' => $this->telefono,                            
                            'usuario' => $this->usuario->codigo
                    ]);
            
            $last_id = $conn->lastInsertId();

            foreach ($this->detalles as $row) {
                $detalle = new DetallePedido();
                $detalle = $row;

                $query = $conn->prepare('INSERT INTO detallepedido(numeroPed,cantidad,descripcion,codigoPre,codigoUni) 
                                    values (:numero, :cantidad,:descripcion, :presentacion, :unidad)');
                $query->execute([
                        'numero' => $last_id,                            
                        'cantidad' => $detalle->cantidad,
                        'descripcion' => $detalle->descripcion,
                        'presentacion' => $detalle->presentacion->codigo,
                        'unidad' => $detalle->unidad->codigo,
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

    public function confirmar(){
        // insertar datos en la BD
        $conn = $this->db->connect();
        
        try{
            $conn->beginTransaction();
            $query = $conn->prepare('UPDATE pedido SET estado = :estado where numero = :numero');
            $query->execute([
                            'estado' => $this->estado,
                            'numero' => $this->numero
                    ]);
  
            $conn->commit();
            return true;
        }catch(PDOException $e){
            $conn->rollback();
            return false;
        }
    }

    public function delete(){

    }

    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT p.numero,p.fecha as fecha_emis,p.fechaEnt as fecha_ent, 
                                                    c.nombre as cliente, sum(dp.cantidad*pre.precio) as importe,
                                                    p.estado 
                                                    from pedido p 
                                                    inner join detallepedido dp on dp.numeroPed = p.numero 
                                                    inner join presentacion pre on pre.codigo = dp.codigoPre 
                                                    inner join cliente c on c.codigo = p.codigoCli 
                                                    where p.estado = 'Pendiente'
                                                    group by p.numero,p.fecha,p.fechaEnt, c.nombre, p.estado");

            while($row = $query->fetch()){
                $item = new Pedido();
                $item->numero = $row['numero'];
                $item->fecha    = $row['fecha_emis'];
                $item->fechaEntrega  = $row['fecha_ent'];
                $item->cliente = new Cliente();
                $item->cliente->nombre = $row['cliente'];
                $item->importe = $row['importe'];
                $item->estado = $row["estado"];

                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getDetallesById($numero){
        $items = [];

        try{
            $query = $this->db->connect()->prepare("SELECT pro.nombre as producto,dp.cantidad,u.nombre as unidad,
                                                    pre.precio,dp.descripcion, (pre.precio*dp.cantidad) as monto
                                                    from pedido p 
                                                    inner join detallepedido dp on dp.numeroPed = p.numero
                                                    inner join presentacion pre on pre.codigo = dp.codigoPre
                                                    inner join producto pro on pro.codigo = pre.codigoProd
                                                    inner join unidad u on u.codigo = dp.codigoUni
                                                    WHERE p.numero = :numpedido");

            $query->execute([
                'numpedido' => $numero
            ]);

            while($row = $query->fetch()){
                $item = new DetallePedido();
                $item->cantidad    = $row['cantidad'];
                $item->descripcion  = $row['descripcion'];
                $item->presentacion = new Presentacion();
                $item->presentacion->precio = $row['precio'];
                $item->presentacion->producto = new Producto();
                $item->presentacion->producto->nombre = $row["producto"];
                $item->unidad = new Unidad();
                $item->unidad->nombre = $row['unidad'];

                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getLastId(){

    }





}

?>