<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Representa la entidad Ingreso de contenedores
*
* @autor Hugo Gallardo
*/
class Registrasalida extends CI_Controller {
    /**
     * Constructor de Clase
    * @param 
    * @return 
    */
    function __construct(){
        parent::__construct();  
        $this->load->model('general/Entregaordentransportes');  
    }
    
  function GetImagen(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Registrasalida | GetImagen()');
        $id = $this->input->post("cont_id");
        $dato= $this->Entregaordentransportes->obtenerImagen_Cont_Id($id);
        echo json_encode($dato);
    }
}