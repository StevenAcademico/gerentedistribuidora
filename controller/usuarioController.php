<?php

require_once "mainController.php";
require_once "model/rolModel.php";


class UsuarioController extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        $this->view->usuarios = [];
        $this->view->sedes = [];
        $this->view->usuario = null;
        $this->view->roles = [];
    }

    function render(){        

    }

    function registro(){

    }

    function editar($param = null){

    }

    function login(){
        $usuario = new Usuario();
        $usuario->userlogin = $_POST['username'];
        $usuario->clave = $_POST['clave'];
        $controller = new MainController();
        $login =$usuario->login();

        if($login != null){
            if($login->vigente == 1){
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $login->codigo;
                $_SESSION['nombre'] = $login->nombre;
                $_SESSION['user'] = $login->userlogin;
                $_SESSION['rol'] = $login->rol->codigo;
                $_SESSION['rol_name'] = $login->rol->nombre;
                
                unset($_SESSION['intentos']);
                header("location: ../main/home");
            }else{
                $controller->view->mensaje = "Su cuenta está temporalmente bloqueada";
                $controller->render();
            }
            

        }else{
            if(!empty($_SESSION["intentos"])){
                $total = $_SESSION["intentos"];
                $total = intval($total) + 1;
                $_SESSION["intentos"] = $total;
            }else{
                $_SESSION['intentos'] = 1;
            }
            
            $totalintentos = $_SESSION["intentos"];
            
            if($totalintentos == 3){                
                $this->model->bloquear($usuario->userlogin);
                $controller->view->mensaje = "Usted a superado el límite de intentos, su cuenta ha sido bloqueada!!";
                $controller->render();
                session_destroy();
            }else{
                $controller->view->mensaje = "Usuario o contraseña incorrecta: Le quedan " . (3 - intval($totalintentos)) . " intentos";
                $controller->render();
            }
            //
        }
    }

    function logout(){
        session_destroy();

        header('location: ../main');
    }

    function guardar(){

    }

    function modificar(){

    }



    function eliminar($id){

    }

}

?>