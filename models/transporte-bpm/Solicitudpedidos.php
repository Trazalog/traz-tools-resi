<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Representa a la Entidad Solicitudpedidos
*
* @autor SLedesma
*/
class Solicitudpedidos extends CI_Model{   
    /**
    * Constructor de Clase
    * @param 
    * @return 
    */
        function __construct(){
            parent::__construct();
        }

    /**
     * carga Lista solicitudes_Pedido
    * @param  string user
    * @return string data
    */
    function Listar_Solicitudes_pedido(){
        $data = userNick();
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Solicitudpedidos | Listar_Solicitudes_pedido()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/solicitudContenedores/$data");
        $aux =json_decode($aux["data"]);
        return $aux;
    }

    /**
     * Guarda Solicitudpedidos
    * @param array datos del pedido
    * @return string status
    */
    function Guardar_Solicitudpedidos($data)
    {   
        log_message('INFO','#TRAZA|Solicitudpedidos|Guardar_Solicitudpedidos() >> '); 
        $post["post_solicitud"] = $data;
        log_message('DEBUG','#Solicitudpedidos/Guardar_Solicitudpedidos: '.json_encode($post));
        $aux = $this->rest->callAPI("POST",REST_RESI."/RECURSO", $post);
        $aux =json_decode($aux["status"]);
        return $aux;
    }
        
    /**
     * Obtiene Transportistas
    * @param 
    * @return array data
    */
    function obtenerTransportista(){

        log_message('INFO','#TRAZA|Solicitudpedidos|obtenerTransportista() >> ');
        $aux = $this->rest->callAPI("GET",REST_RESI."/transportistas");
        $aux =json_decode($aux["data"]);
        return $aux->transportistas->transportista;
    }

    /**
     * Obtiene los tipo de carga
    * @param 
    * @return array data
    */
    function obtener_Tipo_Carga(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Solicitudpedidos | obtener_Tipo_Carga()'); 
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/tipo_carga");
        $aux =json_decode($aux["data"]);
        return $aux->valores->valor;
    }
   
    /**
     * Obtiene tipos de residuos
    * @param int id del transportista
    * @return array data
    */
    function obtenerTipoResiduos($tran_id){
        log_message('DEBUG',"#TRAZA| TRAZ-TOOLS-RESIDUOS | Solicitudpedidos | obtenerTipoResiduos($tran_id)");
        $aux = $this->rest->callAPI("GET",REST_RESI."/transportistas/$tran_id/tipo/carga");
        $aux =json_decode($aux["data"]);
        return $aux->tiposCarga->cargas;
    }
  
    /**
    * Registra un nuevo contenedor
    * @param  array datos del contenedor
    * @return array data
    */
    function RegistrarPedidoContenedor($data){
        $post["solicitudContenedores"] = $data;
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Solicitudpedidos | RegistrarPedidoContenedor() >>'.json_encode($post));
        // $aux = $this->rest->callAPI("POST",REST."/solicitudContenedores", $post); //servicio que llamaba antes de que caiga el server
        $aux = $this->rest->callAPI("POST",API_URL."/solicitudContenedores",$post);
        $aux = json_decode($aux["status"]);
        return $aux;
    }

    function Obtenersoltransp($user){
        $aux = $this->rest->callAPI("GET",REST_RESI."/solicitantesTransporte/".$user);
        $aux =json_decode($aux["data"]);
        return $aux->solicitantes_transporte->sotr_id;
    }   
}
