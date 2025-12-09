<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "/libraries/codigo_qr/phpqrcode/qrlib.php";

class CodigoQR extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model(ALM.'Tablas');
    }
   
    /**
    *  Carga la vista para impresion en modal del codigo QR generado para el vehiculo
    * @param array con datos del vehiculo
    * @return view
    */
    public function cargaModalQRVehiculo(){
        $data = $this->input->post();
        $this->load->view('vehiculos/qr_vehiculos', $data);
    }

     /**
    *  Trae el logo de la empresa de core tablas que se coloca en la impresion del qr
    */
    public function getLogoEmpresa(){
        $data = $this->Tablas->obtenerTablaEmpr_id('residuos_logoQr')['data'][0]->valor;
        echo json_encode($data);
    }
}
