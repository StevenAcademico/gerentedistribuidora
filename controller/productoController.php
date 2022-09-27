<?php

require_once "model/categoriaModel.php";

class ProductoController extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        $this->view->productos = [];
        $this->view->categorias = [];
        $this->view->presentaciones = [];
        $this->view->precios = [];
        $this->view->producto = null;
        $this->view->sedes = [];
    }

    function render(){        
        $Categoria = new Categoria();
        $categorias = $Categoria->get();
        $productos = $this->model->get($_SESSION['sede']);     
        $this->view->categorias = $categorias;   
        $this->view->productos = $productos;        
        $this->view->render('producto/index');
    }



    function getProductByCategoria($param = null){
        $codcategoria = $param[0];
        $productos = $this->model->getProductByCategoria($codcategoria); 
        echo json_encode($productos,JSON_UNESCAPED_UNICODE);

    }


}

?>