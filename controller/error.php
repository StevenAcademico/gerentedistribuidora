<?php

class ErrorFile extends Controller{
    function __construct()
    {
        parent::__construct();
        $this->view->render('error/index');
    }
}

?>