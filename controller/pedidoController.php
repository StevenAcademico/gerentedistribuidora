<?php

require_once "model/categoriaModel.php";
require_once "model/usuarioModel.php";
require_once "model/clienteModel.php";
require_once "model/presentacionModel.php";
require_once "model/unidadModel.php";

class PedidoController extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        $this->view->pedidos = [];
        $this->view->categorias = [];
        $this->view->pedido = null;
    }

    function render(){        
        $pedidos = $this->model->get();        
        $this->view->pedidos = $pedidos;

        $this->view->render('pedido/index');
    }

    function registro(){
        $categoria = new Categoria();
        $categorias = $categoria->get();
        $this->view->categorias = $categorias;
        $this->view->render('pedido/nuevo_pedido');
    }

    function editar($param = null){

    }



    function guardar(){
        $pedido = new Pedido();
        $pedido->direccion = $_POST["direccion"];
        $pedido->fechaEntrega = $_POST["fecha"];
        $pedido->referencia = $_POST["referencia"];
        $pedido->telefono = $_POST["telefono"];
        $pedido->direccion = $_POST["direccion"];
        $pedido->usuario = new Usuario();
        $pedido->usuario->codigo = $_SESSION["idUser"];
        $pedido->cliente = new Cliente();
        $pedido->cliente->codigo = 1;

        $detalles = json_decode($_POST['detalles']);
        foreach ($detalles as $row) {
            $detalle = new DetallePedido();
            $detalle = $row;
            $detalle->cantidad = $row->cantidad;
            $detalle->descripcion = $row->descripcion;
            $detalle->presentacion = new Presentacion();
            $detalle->presentacion->codigo = $row->codpresentacion;
            $detalle->unidad = new Unidad();
            $detalle->unidad->codigo = $row->codunidad;
        }

        $pedido->detalles = $detalles;

        if($pedido->insert()){
            echo json_encode(array("msje" => "Registro exitoso", "cod" => 201));
        }else{
            echo json_encode(array("msje" => "No se pudo realizar el registro", "cod" => 404));
        }
    }


    function modificar(){

    }

    function confirmar(){
        $pedido = new Pedido();
        $pedido->numero = $_SESSION["numPedAux"];
        $pedido->estado = "Confirmado";

        if($pedido->confirmar()){
            unset($_SESSION["numPedAux"]);
            echo json_encode(array("msje" => "Pedido confirmado con éxito", "cod" => 201));
        }else{
            echo json_encode(array("msje" => "No se pudo confirmar el pedido", "cod" => 404));
        }
    }

    function getDetallesById($param = null){
        $numero = $param[0];
        $_SESSION["numPedAux"] = $numero;
        $detalles = $this->model->getDetallesById($numero);
        echo json_encode($detalles,JSON_UNESCAPED_UNICODE);
    }

    function leer($param= null){
        $ruc = $param== null ? '' : $param[0];
        $pedido = $this->model->getByRuc($ruc);
        
        echo json_encode($pedido,JSON_UNESCAPED_UNICODE);
    }

    function eliminar(){

    }

}

?>