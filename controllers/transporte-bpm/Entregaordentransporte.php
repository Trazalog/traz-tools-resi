<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Representa la entidad Ingreso de contenedores
*
* @autor Hugo Gallardo
*/
class Entregaordentransporte extends CI_Controller {
    /**
     * Constructor de Clase
    * @param 
    * @return
    */
    function __construct(){
        parent::__construct();  
        $this->load->model('general/Entregaordentransportes');  
    }

    public function obtenerImagenContenedor(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Entregaordentransporte | obtenerImagenContenedor()');
        $coen_id = $this->input->post('coen');
        $img = $this->Entregaordentransportes->obtenerImagenContenedor($coen_id['coen_id']);
        echo json_encode($img);
    }

    function obtenerDataCamionPesado()
    {
      log_message('DEBUG','#TRAZA|EntregaOrdenTrnasportes | obtenerDataCamionPesado()');
      $equi_id = $this->input->post('equi_id');
      $aux = $this->Entregaordentransportes->obtenerDataCamionPesado($equi_id);
      echo json_encode($aux);
    }
}
