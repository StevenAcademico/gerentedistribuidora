<?php

require_once "model/solicitudModel.php";
require_once "model/detalleCompraModel.php";
include_once "./vendor/autoload.php";
use Dompdf\Dompdf;

class compraController extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        $this->view->cotizacion = [];
        $this->view->proveedor= [];
        $this->view->compras = [];
    }

    function render(){        
        $compra = new  Compra();
        $this->view->compras = $compra->getAll();
        $this->view->render('compra/index');
    }

    public function registro()
    {
        $solicitud = new  Solicitud();
        $compra = new  Compra();
        $this->view->cotizacion = $solicitud->get();  
        $this->view->proveedor = $compra->getProveedor();

        $this->view->render('compra/nueva_compra');
    }

    public function obtenerSolicitud($param = null)
    {
        $id = $param[0];
        $solicitud = new Solicitud();
        $detalle = $solicitud->getSolicitud($id); 
        echo json_encode($detalle,JSON_UNESCAPED_UNICODE);
        
    }

    function guardar(){
        $compra = new Compra();
        $compra->emision = date("Y-m-d");
        $compra->codigoCompra  = $compra->getLastSol();
        $compra->codigoProveedor   =$_POST['Proveedor'];
        $compra->codigoUsuario  = $_SESSION['idUser'];

        $detalles = json_decode($_POST['Detalle']);
        // var_dump($detalles);
        // exit();
        foreach ($detalles as $row) {
            $detalle = new DetalleCompra();
            $detalle->codigoPresentacion = $row->CodPresentacion;
            $detalle->codigoCompra = $compra->codigoCompra;
            $detalle->codigoSolicitud = $row->CodSolicitud;
            $detalle->cantidad = $row->Cantidad;
            $compra->detalle[] = $detalle;
        }
        // var_dump($detalles);
        // exit();
        if($compra->insert()){
            echo json_encode(array("msje" => "Registro Exitoso", "cod" => 201,"Compra" => $compra->codigoCompra));
        }else{
            echo json_encode(array("msje" => "No se pudo realizar el registro", "cod" => 404));
        }
    }

    public function generarPDF($param = null)
    {
        $numero = $param[0];
        $dompdf = new Dompdf();
        $compra = new Compra();
        
        $compraList = $compra->get($numero);
        ob_start();
        include "./views/pdf/compra.php";
        $html = ob_get_clean();
        $dompdf->loadHtml($html);
        $dompdf->render();
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=documento.pdf");
        echo $dompdf->output();
    }

}

?>