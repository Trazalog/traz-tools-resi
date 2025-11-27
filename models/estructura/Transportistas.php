<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Representa a la Entidad Transportistas
*
* @autor Hugo Gallardo
*/
class Transportistas extends CI_Model{
    /**
    * Constructor de Clase
    * @param 
    * @return 
    */
    function __construct(){
        parent::__construct();
    }

    /**
    * Trae listado de Todos los transportistas 
    * @param 
    * @return array datos de todos los transportistas
    */
    function Listar_Transportistas(){   
        log_message('INFO','#TRAZA|TRANSPORTISTAS|Listar_Transportistas() >> ');     
        $aux = $this->rest->callAPI("GET",REST_RESI."/transportistas");
        $aux =json_decode($aux["data"]);       
        return $aux->transportistas->transportista;    
    }

    /**
    * Crea un transportista nuevo
    * @param array datos transportista
    * @return int tran_id (id de transportista nuevo)
    */
    function Guardar_Transportista($data){
        log_message('DEBUG','#Transportistas/Guardar_Transportista: '.json_encode($post));
        $post["transportista"] = $data;
        $aux = $this->rest->callAPI("POST",API_URL."/transportista", $post);
        $aux =json_decode($aux["data"]);
        return $aux->respuesta->tran_id;
    }

    /**
    * Asocia los tipos de carga autorizados a cada transportista
    * @param array con tipos de carga
    * @return string status del servicio
    */	
    function asociarTipoCarga($data){
            log_message('INFO','#TRAZA|TRANSPORTISTAS|asociarTipoCarga() >> ');
            $post['_post_transportistas_tipo_carga_batch_req']['_post_transportistas_tipo_carga'] = $data;
            log_message('DEBUG','#Transportistas/asociarTipoCarga: '.json_encode($post));
            $aux = $this->rest->callAPI("POST",REST_RESI."/_post_transportistas_tipo_carga_batch_req", $post);
            $aux =json_decode($aux["status"]);
            return $aux;
    }

    /**
    * Actualiza datos de transportistas
    * @param array datos de transportista
    * @return string status del servicio
    */
    function Modificar_Transportista($transportista){
        log_message('INFO','#TRAZA|TRANSPORTISTAS|Modificar_Transportista() >> ');
        $data['_put_transportistas'] = $transportista;			
        log_message('DEBUG','#Transportistas/Modificar_Transportista (datos transportista): '.json_encode($data));		
        $aux = $this->rest->callAPI("PUT",REST_RESI."/transportistas", $data);
        $aux =json_decode($aux["status"]);
        return $aux;
    }

    /**
    * borrado logico de transportista
    * @param int id de transportista
    * @return string status del servicio
    */
    function Borrar_Transportista($tran_id){
        log_message('INFO','#TRAZA|TRANSPORTISTAS|Borrar_Transportista() >> ');
        $comp['tran_id'] = $tran_id;
        $comp['eliminado'] = "1";			// para habilitar nuevamente cambiar a "0"
        $data['_put_transportistas_estado'] = $comp;			
        log_message('DEBUG','#Transportistas/Modificar_Transportista (datos transportista): '.json_encode($data));		
        $aux = $this->rest->callAPI("PUT",REST_RESI."/transportistas/estado", $data);
        $aux =json_decode($aux["status"]);
        return $aux;
    }

    /**
    * borrado fisico de tipos de carga asociado a transportista
    * @param int id de transportista
    * @return string status del servicio
    */
    function Borrar_TiposCarga($tran_id){
        log_message('INFO','#TRAZA|TRASNPORTISTAS|Borrar_TiposCarga() >> ');
        $comp['tran_id'] = $tran_id;
        $data['_delete_transportista_tipo_carga'] = $comp;		
        log_message('DEBUG','#Transportistas/Borrar_Transportista (tran_id): '.json_encode($data));		
        $aux = $this->rest->callAPI("DELETE",REST_RESI."/transportista/tipo/carga", $data);
        $aux =json_decode($aux["status"]);
        return $aux;
    }
// ---------------------- FUNCIONES OBTENER ----------------------

    /**
    * Obtiene todos los tipos de carga
    * @param
    * @return array con tipos de carga
    */
    public function obtener_RSU(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportistas | obtener_RSU()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/tipo_carga");
        $aux =json_decode($aux["data"]);
        return $aux->valores->valor;
    }


         /**
    * Obtiene formulario asociado a transportista
    * @param  
    * @return array valor , form_id
    */
    public function obtener_form_transportista(){   
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportistas | obtener_form_transportista()');  
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/configuraciones_log");
        $aux =json_decode($aux["data"]);
        $vals = $aux->valores->valor;
        //obtengo si es transportista
        foreach ($vals as $v) {
                if (isset($v->valor) && $v->valor === 'form_transportista') {
                    $data = isset($v->valor2) ? $v->valor2 : null;
                    break;
                }
            }
        return $data;
    }


     /**
    * Actualiza un  transportista
    * @param  array data
    * @return array int status
    */
    function Set_InfoId_Transportista($data){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportistas | Set_InfoId_Transportista()');
        $post["transportista_info_id"] = $data;
        $aux = $this->rest->callAPI("PUT",REST_RESI2."/transportista/infoId", $post);
        $aux =json_decode($aux["status"]);
        return $aux;
    }

            /**
    * verifica si existe el cuit en base de datos
    * @param  
    * @return boolean true,false
    */
    function valida_Cuit($cuit){
        $aux = $this->rest->callAPI("GET",REST_RESI2."/valida/transportista/".$cuit);
        $aux =json_decode($aux["data"]);
        return $aux->resultado->existe;
	}

}