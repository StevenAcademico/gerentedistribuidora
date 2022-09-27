<?php

class CategoriaController extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        $this->view->categorias = [];
    }

    function render(){
        $categorias = $this->model->get();
        $this->view->categorias = $categorias;
        $this->view->render('categoria/index');
    }

    function registro(){
        $this->view->render('categoria/nueva_categoria');
    }

    function editar($param = null){
        $id = $param[0];
        $categoria = $this->model->getById($id); 
        
        //guardamos el codproducto en un session para mayor seguridad
        $_SESSION['idcategoria'] = $id;        
        $this->view->categoria = $categoria;
        $this->view->render('categoria/editar_categoria');
    }




    function leer($param= null){
        $id = $param== null ? '' : $param[0];
        $categoria = $this->model->getById($id);
        
        echo json_encode($categoria,JSON_UNESCAPED_UNICODE);
    }


}

?>