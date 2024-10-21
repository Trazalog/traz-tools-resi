<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Representa la entidad Ingreso de contenedores
*
* @autor Hugo Gallardo
*/
class RegistraSalida extends CI_Controller {
    /**
     * Constructor de Clase
    * @param 
    * @return 
    */
    function __construct(){
        parent::__construct();  
        $this->load->model('general/EntregaOrdenTransportes');  
    }
    
  function GetImagen(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | RegistraSalida | GetImagen()');
        $id = $this->input->post("cont_id");
        $dato= $this->EntregaOrdenTransportes->obtenerImagen_Cont_Id($id);  
        echo json_encode($dato);
    }
}