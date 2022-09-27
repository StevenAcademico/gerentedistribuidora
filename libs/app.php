<?php

require_once "controller/error.php";

class App {

    
    function __construct()
    {
        
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        // var_dump(md5(12345678));
        $url = rtrim($url,'/');
        $url = explode('/',$url);

        if(empty($url[0])){
            $file = 'controller/mainController.php';
            require_once $file;
            $controller = new MainController();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }

        $file = 'controller/'.$url[0].'Controller.php';        

        if(file_exists($file)){
            require_once $file;

            $name_controller = $url[0].'Controller';
            $controller = new $name_controller;
            $controller->loadModel($url[0]);

            // # elementos del arreglo
            $nparam = sizeof($url);

            if($nparam > 1){
                if($nparam > 2){
                    $param = [];
                    for($i = 2; $i<$nparam; $i++){
                        array_push($param, $url[$i]);
                    }
                    $controller->{$url[1]}($param);
                }else{
                    $controller->{$url[1]}();
                }
            }else{
                $controller->render();
            }

        }else{
            $controller = new ErrorFile();    
        }
    }    
}

?>