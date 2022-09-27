<?php

class ClienteController extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        $this->view->clientes = [];
        $this->view->cliente = null;
    }

    function render(){        
        $clientes = $this->model->get();        
        $this->view->clientes = $clientes;        
        $this->view->render('cliente/index');
    }

    function registro(){
        $this->view->render('cliente/nuevo_cliente');
    }

    function editar($param = null){

    }



    function guardar(){

    }


    function modificar(){

    }

    function leer($param= null){
        $ruc = $param== null ? '' : $param[0];
        $cliente = $this->model->getByRuc($ruc);
        
        echo json_encode($cliente,JSON_UNESCAPED_UNICODE);
    }

    function eliminar(){

    }

}

?>