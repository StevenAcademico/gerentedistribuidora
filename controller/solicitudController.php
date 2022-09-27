<?php

require_once "model/presentacionModel.php";
require_once "model/detalleSolicitudModel.php";
include_once "./vendor/autoload.php";
use Dompdf\Dompdf;

class SolicitudController extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        $this->view->solicitudes = [];
        $this->view->solicitud = null;
        $this->view->presentaciones = [];
        $this->view->productoSolicitar = [];
    }

    function render(){        
        $solicitudes = $this->model->get();        
        $this->view->solicitudes = $solicitudes;        
        $this->view->render('solicitud/index');
    }

    function registro(){
        $presentacion = new Presentacion();
        $presentaciones = $presentacion->getPresentacionDetail();
        $this->view->presentaciones = $presentaciones;  
        $solicitud = new Solicitud();
        $this->view->productoSolicitar = $solicitud->getProductoSolicitar();
        $this->view->render('solicitud/nueva_solicitud');
    }

    function guardar(){
        $solicitud = new Solicitud();
        $solicitud->fecha = date("Y-m-d");
        $solicitud->codigo = $solicitud->getLastSol();

        $detalles = json_decode($_POST['detalles']);
        foreach ($detalles as $row) {
            $detalle = new DetalleSolicitud();
            $detalle = $row;
            $detalle->cantidadSolicitada = intval($row->CantidadSolicitar);
            $detalle->presentacion = $row->CodPresentacion;
        }

        $solicitud->detalles = $detalles;

        if($solicitud->insert()){
            echo json_encode(array("msje" => "Registro Exitoso", "cod" => 201,"Cotizacion" => $solicitud->codigo));
        }else{
            echo json_encode(array("msje" => "No se pudo realizar el registro", "cod" => 404));
        }
    }

    public function generarPDF($param = null)
    {
        $numero = $param[0];
        $dompdf = new Dompdf();
        $solicitud = new Solicitud();
        
        $cotizacion = $solicitud->getSolicitud($numero);
        ob_start();
        include "./views/pdf/cotizacion.php";
        $html = ob_get_clean();
        $dompdf->loadHtml($html);
        $dompdf->render();
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=documento.pdf");
        echo $dompdf->output();
    }

}

?>