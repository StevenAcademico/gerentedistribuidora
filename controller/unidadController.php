

<?php

class UnidadController extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        $this->view->categorias = [];
    }

    function getUnidadByProductYPresentacion($param= null){
        $producto = $param[0];
        $presentacion = $param[1];
        $unidades = $this->model->getUnidadByProductYPresentacion($producto,$presentacion);
        
        echo json_encode($unidades,JSON_UNESCAPED_UNICODE);
    }


}

?>