<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Representa la entidad Ingreso de contenedores
*
* @autor Hugo Gallardo
*/
class EntregaOrdenTransporte extends CI_Controller {
    /**
     * Constructor de Clase
    * @param 
    * @return
    */
    function __construct(){
        parent::__construct();  
        $this->load->model('general/EntregaOrdenTransportes');  
    }

    public function obtenerImagenContenedor(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | EntregaOrdenTransporte | obtenerImagenContenedor()');
        $coen_id = $this->input->post('coen');
        $img = $this->EntregaOrdenTransportes->obtenerImagenContenedor($coen_id['coen_id']);
        echo json_encode($img);
    }
}
