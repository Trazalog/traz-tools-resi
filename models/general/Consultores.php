<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Representa a la Entidad Consultores
*
* @autor Hugo Gallardo
*/
class Consultores extends CI_Model{
    /**
    * Constructor de Clase
    * @param 
    * @return 
    */
    function __construct(){
        parent::__construct();
    }		


    /**
    * Obtiene los tipos de profesiones
    * @param  
    * @return array valor , tipo de profesiones
    */
    public function obtener_Profesion_Consultor(){   
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultores | obtener_Profesion_Consultor()');  
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/consultor_profesion");
        $aux =json_decode($aux["data"]);
        return $aux->valores->valor;
    }


    
    /**
    * verifica si existe el registro en base de datos
    * @param  
    * @return boolean true,false
    */
    function valida_Registro($registro){
        $aux = $this->rest->callAPI("GET",REST_RESI."/validaRegistroConsultor/".$registro);
        $aux =json_decode($aux["data"]);
        return $aux->resultado->existe;
	}

    /**
    * guarda nuevo consultor
    * @param  
    * @return 
    */
    function Guardar_Consultor($datos){
        $post["_post_consultores"] = $datos;
        $aux = $this->rest->callAPI("POST",REST_RESI."/consultor", $post);
        $aux =json_decode($aux["status"]);
        return $aux;
	}


    /**
    * Lista los consultores, obtiene los consultores para listarlos
    * @param 
    * @return array consultores
    */
    function Listar_Consultores(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultores | Listar_Consultores()');  
        $aux = $this->rest->callAPI("GET",REST_RESI."/consultores");
        $aux =json_decode($aux["data"]);       
        return $aux->consultores->consultor;
    }


    /**
    * Actualiza un  consultor
    * @param  array data
    * @return array int status
    */
    function actualizar_Consultor($data){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultores | actualizar_Consultor()');
        $post["consultores"] = $data;
        $aux = $this->rest->callAPI("PUT",REST_RESI."/consultores", $post);
        $aux =json_decode($aux["status"]);
        return $aux;
    }


     /**
    * Borra un  consultor
    * @param  array data
    * @return array int status
    */
    function eliminar_Consultor($data){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultores | eliminar_Consultor()');
        $post["estado"]= $data;
        $aux = $this->rest->callAPI("PUT",REST_RESI."/consultorEstado", $post);
        $aux =json_decode($aux["status"]);
        return $aux;
    }


}