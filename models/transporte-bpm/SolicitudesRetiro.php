<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Representa a la Solicitud de Retiro de Contenedores
*
* @autor Hugo Gallardo
*/
class SolicitudesRetiro extends CI_Model {
  
  /**
  * constructor de clase SolicitudRetiro
  * @param 
  * @return 
  */
  function __construct(){
    parent::__construct();
  }     

  // ---------------------- FUNCIONES OBTENER ----------------------
  
  /**
  * Devuelve id de proxima solicitud de retiro
  * @param 
  * @return int nuevo_sore_id
  */
  function solicitudRetiroProx(){
    log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudesRetiro | solicitudRetiroProx()');
		$aux = $this->rest->callAPI("GET",REST_RESI."/solicitudRetiro/prox");
		$aux =json_decode($aux["data"]);   
		return $aux->respuesta->nuevo_sore_id;
	}

  /**
  * Trae listado de Todos los transportistas 
  * @param 
  * @return array datos de todos los transportistas
  */  
  function obtener_Transportista(){
    log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudesRetiro | obtener_Transportista()');
    $aux = $this->rest->callAPI("GET",REST_RESI."/transportistas");
    $aux =json_decode($aux["data"]);
    return $aux->transportistas->transportista;
  }

  /**
  * Obtiene los tipos de carga autorizados de cada transportista
  * @param 
  * @return array con tipos de carga
  */
  public function obtener_Tipo_residuo($tran_id){
    log_message('DEBUG',"#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudesRetiro | obtener_Tipo_residuo($tran_id)");
    $aux = $this->rest->callAPI("GET",REST_RESI."/transportistas/".$tran_id."/tipo/carga");
    $aux =json_decode($aux["data"]);
    return $aux->tiposCarga->cargas;				
  }

  /**
  * Devuelve contenedores a retirar por usuario logueado y por tipo de carga
  * @param string tipo carga, string nick
  * @return array con info contenedores a entregar
  */
  function obtenerContenedor($tica_id, $usernick, $tran_id){
    log_message('DEBUG',"#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudesRetiro | obtenerContenedor($tica_id, $usernick, $tran_id)");
    $carga = urlencode($tica_id); // saca los espacios del string de tipo de carga
    $aux = $this->rest->callAPI("GET",REST_RESI."/contenedoresEntregados/tipocarga/".$carga."/user/".$usernick."/".$tran_id);
    $aux =json_decode($aux["data"]);
    return $aux->contenedores->contenedor;
  }
  /**
  * Crea nueva solicitud de Retiro iniciando un nuevo proceso
  * @param array con datos de los contenedores e info de solicitante de transporte(generador)
  * @return string estado de respuesta del servicio
  */
  function Guardar_solicitudRetiro($data){
    log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudesRetiro | Guardar_solicitudRetiro()');
    $post["solicitudRetiroContenedores"] = $data;      
    $aux = $this->rest->callAPI("POST",API_URL."/solicitudRetiroContenedores",$post);
    $aux = json_decode($aux['status']);
    return $aux;
  }

  function obtenerContenedorCont_id($cont_id){
    log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | SolicitudesRetiro | obtenerContenedorCont_id()');
    $aux = $this->rest->callAPI("GET",REST_RESI."/contenedores/$cont_id");
    $aux = json_decode($aux["data"]);
    return $aux->contenedor;
  }
}