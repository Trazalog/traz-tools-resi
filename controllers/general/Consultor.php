<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Representa a la Entidad Consultor
*
* @autor 
*/

class Consultor extends CI_Controller {

    /**
    * Constructor de clase
    * @param 
    * @return 
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model('general/Consultores');
    }


     /**
	 *template obtiene los datos necesarios carga  la vista con ellos
	* @param 
	* @return view registrar_consultor
	*/  
	
	function templateEvaluador(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultor | templateConsultor()');  
        $data['profesiones'] = $this->Consultores->obtener_Profesion_Consultor();
        $this->load->view('consultores/registrar_consultor',$data);
	}


    /**
	*verifica si ya fue cargado el registro
	* @param 
	* @return true,false
	*/  
	
	function valida_registro(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultor | valida_registro()');  
        $registro = $this->input->get('registro');
        $data = $this->Consultores->valida_Registro($registro);
        echo $data;
	}

    /**
	 *Guarda un consultor nuevo 
	* @param 
	* @return string "ok","error"
	*/  
	function Guardar_Consultor(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultor | Guardar_Consultor()');

        $datos =  $this->input->post('datos');

        $evaluador = $this->Consultores->Guardar_Consultor($datos);

        if($evaluador){
			echo json_encode([
            	"status" => "ok"
        	]);
        }else{
			log_message('ERROR','#TRAZA|Consultor|Guardar_Consultor() >> $resp: '.$resp);
			echo "error";
        }
	}


     /**
	 *Lista los consultores
	* @param 
	* @return view Listar_Consultores
	*/  
	function Listar_Consultores(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultor | Listar_Consultores()');
        $data['evaluadores'] = $this->Consultores->Listar_Consultores();
        $this->load->view('consultores/lista_consultor',$data);
	}


         /**
	 *Edita datos de un consultor existente
	* @param 
	* @return string "ok","error"
	*/  
	function Actualizar_Consultor(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultor | Actualizar_Consultor()');

        $datos =  $this->input->post('consultor');

        $consultor = $this->Consultores->actualizar_Consultor($datos);

        if($consultor){
			echo "ok";
        }else{
			log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultor | Actualizar_Consultor() >> $resp: '.$resp);
			echo "error";
        }
	}
        
        /**
	 *Elimina datos de un consultor existente
	* @param 
	* @return string "ok","error"
	*/  
	function Eliminar_Consultor(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultor | Eliminar_Consultor()');

                $datos =  $this->input->post('elimina');

                $resp = $this->Consultores->eliminar_Consultor($datos);

                if($resp){
                                echo "ok";
                }else{
                                log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Consultor | Eliminar_Consultor() >> $resp: '.$resp);
                                echo "error";
                }
	}
    
}
?>