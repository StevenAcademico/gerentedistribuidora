<?php

require_once "model/productoModel.php";
require_once "model/clienteModel.php";

class MainController extends Controller {
    function __construct()
    {
        parent::__construct();
        $this->view->mensaje="";
        
    }

    function render()
    {
        //var_dump($_SESSION);die();
        $sede = isset($_SESSION) ? 1 : $_SESSION['sede'];
        $this->view->render('main/index');
    }

    function home()
    {
        require_once "model/usuarioModel.php";
        $this->view->render('main/home');
    }


}

?>