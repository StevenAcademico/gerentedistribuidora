<?php

class PresentacionController extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        $this->view->presentaciones = [];
        $this->view->presentacion = null;
    }

    function render(){        
        $presentaciones = $this->model->get();        
        $this->view->presentaciones = $presentaciones;        
        $this->view->render('presentacion/index');
    }

    function getActivosByProducto($param = null){
        $codproducto = $param[0];
        $presentaciones = $this->model->getActivosByProducto($codproducto); 
        echo json_encode($presentaciones,JSON_UNESCAPED_UNICODE);
    }

}

?>