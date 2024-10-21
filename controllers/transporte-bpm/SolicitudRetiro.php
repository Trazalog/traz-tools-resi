<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Represent a Solicitud de Retiro de Contenedores
*
* @autor Hugo Gallardo
*/
class SolicitudRetiro extends CI_Controller {
    /**
     * Constructor de Clase
    * @param 
    * @return 
    */
    function __construct(){
        parent::__construct();
        $this->load->model('transporte-bpm/SolicitudesRetiro');
    }

    /**
     * Carga pantalla ABM Solicitud retiro y listado general
    * @param 
    * @return 
    */
    function templateSolicitudRetiro(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudRetiro | templateSolicitudRetiro()');
        $data['transportista'] = $this->SolicitudesRetiro->obtener_Transportista();
        $data['nuevo_sore_id'] = $this->SolicitudesRetiro->solicitudRetiroProx();
        //$data['contenedores'] =  $this->SolicitudesRetiro->obtenerContenedor();
        $this->load->view('transporte-bpm/SolicitudRetiro/Registrar_solicitud_retiro', $data);
    }
    
    
    function Guardar_SolicitudRetiro(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudRetiro | Guardar_SolicitudRetiro()');
        $solicitud = $this->input->post('datos');

        $solicitud['usuario_app'] = userNick();
        $solicitud['sotr_id'] = usrIdGeneradorByNick();

        $resp = $this->SolicitudesRetiro->Guardar_solicitudRetiro($solicitud);
        if($resp){
            echo "ok";
        }else{
            log_message('ERROR','#TRAZA|SOLICITUDRETIRO|Guardar_SolicitudRetiro() >> $resp: '.$resp);
            echo 'error';
        }
    }
        
    
    function Listar_SolicitudesRetiro(){
        // $data["solicitudes_retiros"] = $this->Contenedores->Listar_Solicitudes_retiro();
        $this->load->view('layout/Contenedores/Lista_solicitudes_retiro',$data);
    }
        

    // ---------------- Funciones Obtener --------------------------------//

    /**
     * Devuelve tipos de carga autorizados por transportista
    * @param int tran_id
    * @return array tipos de carga autorizados de un transportista
    */
    function obtener_Tipo_residuo(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudRetiro | obtener_Tipo_residuo()');
        $response = $this->SolicitudesRetiro->obtener_Tipo_residuo($this->input->post('tran_id'));
        echo json_encode($response);
    }

    /**
     * Devuelve contenedores a retirar por usuario logueado y por tipo de carga
    * @param string tipo carga
    * @return array coninfo contenedores a entregar
    */
    function obtenerContenedor(){     
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudRetiro | obtenerContenedor()');
        $tica_id = $this->input->post('tica_id');
        $tran_id = $this->input->post('Tran_id');
        $usernick = userNick();
        $resp =$this->SolicitudesRetiro->obtenerContenedor($tica_id, $usernick, $tran_id);
        echo json_encode($resp);
    }
    function ObtenerContenedorCont_id(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudRetiro | ObtenerContenedorCont_id()');
        $cont_id = $this->input->post('cont_id');
        $resp =$this->SolicitudesRetiro->obtenerContenedorCont_id($cont_id);
        echo json_encode($resp);
    }
}