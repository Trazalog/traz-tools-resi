<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Representa a la Entidad Evaluador
*
* @autor 
*/

class Evaluador extends CI_Controller {

    /**
    * Constructor de clase
    * @param 
    * @return 
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model('general/Evaluadores');
    }


    /**
	 *template obtiene los datos necesarios carga  la vista con ellos
	* @param 
	* @return view registrar_generadores
	*/  
	
	function templateEvaluador(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | templateEvaluador()');  
        $data['formaciones'] = $this->Evaluadores->obtener_Formacion_Evaluador();
        $this->load->view('evaluadores/registrar_evaluador',$data);
	}


    /**
	*verifica si ya fue cargado el dni
	* @param 
	* @return true,false
	*/  
	
	function valida_dni(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | valida_dni()');  
        $dni = $this->input->get('dni');
        $data = $this->Evaluadores->valida_dni($dni);
        echo $data;
	}


    /**
	 *Guarda un evaluador nuevo 
	* @param 
	* @return string "ok","error"
	*/  
	function Guardar_Evaluador(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | Guardar_Evaluador()');

        $datos =  $this->input->post('datos');

        $evaluador = $this->Evaluadores->Guardar_Evaluador($datos);

        if($evaluador){
			echo json_encode([
            	"status" => "ok"
        	]);
        }else{
			log_message('ERROR','#TRAZA|Generador|Guardar_Generador() >> $resp: '.$resp);
			echo "error";
        }
	}

   /**
	 *Lista los evaluadores
	* @param 
	* @return view lista_evaluadores
	*/  
	function Listar_Evaluadores(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | Listar_Evaluadores()');
        $data['evaluadores'] = $this->Evaluadores->Listar_Evaluadores();
        $this->load->view('evaluadores/lista_evaluadores',$data);
	}
	   
	/**
	 *Lista los evaluadores
	* @param 
	* @return view lista_evaluadores
	*/  
	public function Get_Evaluadores()
        {
                log_message('DEBUG', '#TRAZA | Evaluador | Get_Evaluadores()');
                $evaluadores = $this->Evaluadores->Get_Evaluadores();
                echo json_encode($evaluadores);

        }

        /**
	 *Edita datos de un evaluador existente
	* @param 
	* @return string "ok","error"
	*/  
	function Actualizar_Evaluador(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | Actualizar_Evaluador()');

        $datos =  $this->input->post('evaluador');

        $evaluador = $this->Evaluadores->actualizar_Evaluador($datos);

        if($evaluador){
			echo "ok";
        }else{
			log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | Actualizar_Evaluador() >> $resp: '.$resp);
			echo "error";
        }
	}

    
        /**
	 *Elimina datos de un evaluador existente
	* @param 
	* @return string "ok","error"
	*/  
	function Eliminar_Evaluador(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | Eliminar_Evaluador()');

        $datos =  $this->input->post('elimina');

        $resp = $this->Evaluadores->eliminar_Evaluador($datos);

        if($resp){
			echo "ok";
        }else{
			log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | Eliminar_Evaluador() >> $resp: '.$resp);
			echo "error";
        }
	}

           /**
	 *Valida si un evaluador esta asociado a algun formulario de solicitante_transporte
	* @param 
	* @return  array datos, "error"
	*/  
	function Validar_Evaluador_Asociado(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | Validar_Evaluador_Asociado()');

        $datos =  $this->input->post('dni');

        $resp = $this->Evaluadores->Validar_Evaluador_Asociado($datos);

        if($resp){
			echo json_encode($resp);
        }else{
			log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Evaluador | Validar_Evaluador_Asociado() >> $resp: '.$resp);
			echo "error";
        }
	} 

    
}
?>