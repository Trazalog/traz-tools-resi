<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Representa a la Entidad Evaluadores
*
* @autor Hugo Gallardo
*/
class Evaluadores extends CI_Model{
    /**
    * Constructor de Clase
    * @param 
    * @return 
    */
    function __construct(){
        parent::__construct();
    }		


    /**
    * Obtiene los tipos de Evaluadores
    * @param  
    * @return array valor , tipo de evaluadores
    */
    public function obtener_Formacion_Evaluador(){   
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluadores | obtener_Formacion_Evaluador()');  
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/evaluador_formacion");
        $aux =json_decode($aux["data"]);
        return $aux->valores->valor;
    }


    /**
    * verifica si existe el dni en base de datos
    * @param  
    * @return boolean true,false
    */
    function valida_dni($dni){
        $aux = $this->rest->callAPI("GET",REST_RESI."/validaEvaluador/".$dni);
        $aux =json_decode($aux["data"]);
        return $aux->resultado->existe;
	}


    /**
    * guarda nuevo evaluador
    * @param  
    * @return 
    */
    function Guardar_Evaluador($datos){
        $post["_post_evaluadores"] = $datos;
        $aux = $this->rest->callAPI("POST",REST_RESI."/evaluadores", $post);
        $aux =json_decode($aux["status"]);
        return $aux;
	}


    /**
    * Lista los evaluadores, obtiene los evaluadores para listarlos
    * @param 
    * @return array evaluadores
    */
    function Listar_Evaluadores(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluadores | Listar_Evaluadores()');  
        $aux = $this->rest->callAPI("GET",REST_RESI."/evaluadores");
        $aux =json_decode($aux["data"]);       
        return $aux->evaluadores->evaluador;
    }
    
      /**
    * Lista los evaluadores, obtiene los evaluadores para listarlos
    * @param 
    * @return array evaluadores
    */
    function Get_Evaluadores(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluadores | Listar_Evaluadores()');  
        $aux = $this->rest->callAPI("GET",REST_RESI."/evaluadores");
        $aux =json_decode($aux["data"]); 
        return $aux->evaluadores->evaluador;
    }

    /**
    * Actualiza un  evaluador
    * @param  array data
    * @return array int status
    */
    function actualizar_Evaluador($data){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluadores | actualizar_Evaluador()');
        $post["evaluadores"] = $data;
        $aux = $this->rest->callAPI("PUT",REST_RESI."/evaluadores", $post);
        $aux =json_decode($aux["status"]);
        return $aux;
    }


        /**
    * Borra un  evaluador
    * @param  array data
    * @return array int status
    */
    function eliminar_Evaluador($data){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluadores | eliminar_Evaluador()');
        $post["estado"]= $data;
        $aux = $this->rest->callAPI("PUT",REST_RESI."/evaluadorEstado", $post);
        $aux =json_decode($aux["status"]);
        return $aux;
    }

            /**
    * valida un  evaluador si esta asociado a un formulario de solicitante_transporte
    * @param  array data
    * @return array int status
    */
    function Validar_Evaluador_Asociado($dni){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluadores | Validar_Evaluador_Asociado()');
        $form_id = $this->obtener_form();
        $aux = $this->rest->callAPI("GET",REST_RESI."/validaDeleteEvaluador/".$form_id."/".$dni);
        $aux =json_decode($aux["data"]);
        return $aux->respuestas->respuesta;
    }


    /**
    * Obtiene formulario asociado a generador
    * @param  
    * @return array valor , form_id
    */
    public function obtener_form(){   
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluadores | obtener_form()');  
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/configuraciones_log");
        $aux =json_decode($aux["data"]);
        $vals = $aux->valores->valor;
        //obtengo si es generador
        foreach ($vals as $v) {
                if (isset($v->valor) && $v->valor === 'form_generadores') {
                    $data = isset($v->valor2) ? $v->valor2 : null;
                    break;
                }
            }
        return $data;
    }

}